<?php 
 require('util.php');
    $util = new util();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>NewPointe Roku Uploader</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="topPan">
	<a href="index.php"><img src="images/newpointe.png" alt="NewPointe" wborder="0" class="logo" title="NewPointe" /></a>
	</div>

<div id="bodyPan">
        <br />
        <?php include ("includes/notification.php"); ?>
	</div>
    
    <div id="bodybottomPan">
	  <div id="bottomleftPan">
	  	<h2>Add A Message<br /></h2>

		<p class="more"><a href="addMessage">Add Message</a></p>
	  </div>
	  
	  <div id="bottomrightPan">
	  	<h2>Add A Series<br /></h2>
		
		<p class="more"><a href="addSeries">Add Series</a></p>
	  </div>
        
        
        <div id="archive">
        <h2>Current Roku Message Archive</h2>
        
        <?php
    $messageArray = array();
$con = mysql_connect($util->getDatabasePath(),$util->getDatabaseUser(),$util->getDatabasePass());
                    if (!$con)
                    {
                    die('Could not connect: ' . mysql_error());
                    }

                    mysql_select_db($util->getDatabaseName(), $con);

                    $result = mysql_query("SELECT * FROM series order by enddate DESC;");

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

                            echo "<h3>$name</h3>";
                            
                            echo "<ul>";
                            
                            //get all messages in series
                            $result2 = mysql_query("SELECT * FROM message WHERE series_id = '$seriesid';");

                                while($row = mysql_fetch_array($result2))
                                {
                                    $numberofmessages++;
                                    
                                    $messageid = $row["id"];
                                    $messagename = $row["name"];
                                    $date = $row["date"];
                                    $communicator = $row["communicator"];
                                    $description = $row["description"];
                                    $runtime = $row["runtime"];
                                    $fileurl = $row["fileurl"];

                                    
                                    echo "<li>$messagename</li>";
                                }
                                
                              
                                echo "</ul><br />";

                                }

                    mysql_close($con);
                    
        
        
        ?>
        
        
        
        
        
        </div>
	</div>
	
	<div id="footermainPan">
  <div id="footerPan">

		<p class="copyright">Build 27-2.6</p>
  </div>
</div>
</body>
</html>
