<?php

    require('util.php');
    $util = new util();
    
    echo "Please wait.  Updating the Roku XML on S3...";
    
    if (!class_exists('S3')) require_once 'S3.php';
    

// AWS access info
$s3 = new S3($util->getAwsAccessKey(), $util->getAwsSecretKey());
$bucketName = $util->getBucketName() . 'xml'; 

    
    date_default_timezone_set('EST');
    $today = date("Ymd");
    
    //File Path Prefix
    //$filepath = '/Users/bwitting/Development/NewPointeRokuEdit/'; //always end with a slash
    $filepath = '/var/www/roku.newpointe.org/htdocs/xml/'; //always end with a slash

    $xmlpath = "http://s3.amazonaws.com/NewPointeRoku/xml/";  //always end with a slash
    $imagepath = "http://s3.amazonaws.com/NewPointeRoku/images/";  //always end with a slash
    $videopath = "http://s3.amazonaws.com/NewPointeRoku/videos/";  //always end with a slash
    
    $currentseriesxml = "1";
    
    
    
    //generate XML for series
    $seriesArray = array();
    $messageArray = array();
$con = mysql_connect($util->getDatabasePath(),$util->getDatabaseUser(),$util->getDatabasePass());
                    if (!$con)
                    {
                    die('Could not connect: ' . mysql_error());
                    }

                    mysql_select_db($util->getDatabaseName(), $con);

                    $result = mysql_query("SELECT * FROM series where enabled = true ORDER BY endDate DESC;");

                    while($row = mysql_fetch_array($result))
                    {
                       $numberofmessages = 0;
                        $messageArray = array();
                        
                        $seriesid = $row["id"];
                        $name = $row["seriesname"];
                        $description = $row["description"];
                        $startdate = $row["startdate"];
                        $endate = $row["enddate"];
                        $feedURL = $row["feedurl"];
                        $imageURL = $row["imageurl"];
                        
                        if(time() < date(strtotime($endate). " +9 days")){
                            $currentseriesxml = $feedURL;
                        }

                        
                        $series = array();
                            $series['title'] = $name;
                            $series['description'] = $description;
                            $series['feed'] = $feedURL;


                            array_push($seriesArray, $series);
                            
                            
                            
                            //get all messages in series
                            $result2 = mysql_query("SELECT * FROM message WHERE series_id = '$seriesid' ORDER BY date ASC;");

                                while($row = mysql_fetch_array($result2))
                                {
                                    $numberofmessages++;
                                    
                                    $messageid = $row["id"];
                                    $messagename = $row["name"];
                                    $date = $row["date"];
                                    $communicator = $row["communicator"];
                                    //$description = $row["description"];
                                    $runtime = $row["runtime"];
                                    $fileurl = $row["fileurl"];
                                    
                                    $message = array();
                                    $message['id'] = $messageid;
                                    $message['name'] = $messagename;
                                    $message['description'] = $description;
                                    $message['date'] = $date;
                                    $message['communicator'] = $communicator;
                                    $message['runtime'] = $runtime;
                                    $message['fileurl'] = $fileurl;
                                    
                                    array_push($messageArray, $message);
                                }
                                
                                //Generate series.xml for each series
                                $file = $filepath . $feedURL;
                                $seriescontents = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n";
                                $seriescontents .= '<feed>' . "\n";
                                $seriescontents .= '<resultLength>' . $numberofmessages . '</resultLength>' . "\n";
                                $seriescontents .= '<endIndex>' . $numberofmessages . '</endIndex>' . "\n\n";
                                
                                foreach ($messageArray as $m) {
                                    $seriescontents .=  '<item sdImg="' . $imagepath . $imageURL . '" hdImg="' . $imagepath . $imageURL . '">' . "\n" ;
                                    $seriescontents .=  '<title>'. $m["name"] .'</title>' . "\n" ;
                                    $seriescontents .=  '<contentId>'. $m["id"] .'</contentId>' . "\n" ;
                                    $seriescontents .=  '<contentType>Talk</contentType>' . "\n" ;
                                    $seriescontents .=  '<contentQuality>SD</contentQuality>' . "\n" ;
                                    $seriescontents .=  '<streamFormat>mp4</streamFormat>' . "\n" ;
                                    $seriescontents .=  '<media>' . "\n" ;
                                    $seriescontents .=  '<streamQuality>SD</streamQuality>' . "\n" ;
                                    $seriescontents .=  '<streamBitrate>1500</streamBitrate>' . "\n" ;
                                    $seriescontents .=  '<streamUrl>' . $videopath . $m["fileurl"] . '</streamUrl>' . "\n" ;
                                    $seriescontents .=  '</media>' . "\n" ;
                                    $seriescontents .=  '<synopsis>Program Date: ' . $m["date"] .  ' Communicator: ' . $m["communicator"] . '.  ' . $m["description"] . ' </synopsis>' . "\n" ;
                                    $seriescontents .=  '<genres>' . $name  .'</genres>' . "\n" ;
                                    $seriescontents .=  '<runtime>' . $m["runtime"] . '</runtime>' . "\n" ;
                                    $seriescontents .=  '</item>' . "\n\n" ;
                                    }
                                $seriescontents .= '</feed>' . "\n";
                                file_put_contents($file, $seriescontents);
                                $s3->deleteObject($bucketName, baseName($file));
                                $s3->putObjectFile($file, $bucketName, baseName($file), S3::ACL_PUBLIC_READ);

                                }

                    mysql_close($con);
                    
                    
            //Generate categories.xml
            $file = $filepath . 'categories.xml';
            $contents = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n";
            $contents .= '<categories>' . "\n";
            $contents .= '<category title="Live Stream" description="Watch NewPointe Live on Sundays at 9:00am and 11:00am" sd_img="' . $imagepath . 'live.png" hd_img="' . $imagepath . 'live.png">' . "\n";
            $contents .= '<categoryLeaf title="Live Stream" description="" feed="' . $xmlpath . 'livestream.xml"/>' . "\n";
            $contents .= '</category>' . "\n";
            //$contents .= '<category title="Current Series" description="Watch messages from the current message series." sd_img="' . $imagepath . 'currentseries.png" hd_img="' . $imagepath . 'currentseries.png">' . "\n";
            //$contents .= '<categoryLeaf title="Current Message Series" description="" feed="' . $xmlpath . $currentseriesxml . '" />' . "\n";
            //$contents .= '</category>' . "\n";
            $contents .= '<category title="Series and Messages" description="Watch NewPointe messages" sd_img="' . $imagepath . 'pastseries.png" hd_img="' . $imagepath . 'pastseries.png">' . "\n";
            foreach ($seriesArray as $a) {$contents .=  '<categoryLeaf title="' . $a['title'] . '" description="' . $a['description'] . '" feed="' . $xmlpath . '' . $a['feed'] . '"/>' . "\n" ; }
            $contents .= '</category>' . "\n";
            $contents .= '</categories>';
            file_put_contents($file, $contents);
            $s3->deleteObject($bucketName, baseName($file));
            $s3->putObjectFile($file, $bucketName, baseName($file), S3::ACL_PUBLIC_READ);

                    
            
            
     
    //generate XML for messages
            
                    
                    

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    
    <title>Updating XML</title>
</head>

<body>

    Please wait.  Updating the Roku XML on S3...
    <script language="Javascript">document.location.replace("success.php");</script>;
    
</body>
</html>
