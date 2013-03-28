<?php

if (!class_exists('S3')) require_once 'S3.php';
require('util.php');
    $util = new util();


$bucketName = $util->getBucketName() . 'images';

$s3 = new S3($util->getAwsAccessKey(), $util->getAwsSecretKey());


    //$user = $_SESSION["loggedInAs"];
    $user = "bronson";

    $name = $_POST["name"];
    $description= $_POST["description"];
    $startdate = $_POST["startdate"];
    $enddate = $_POST["enddate"];
    
    $graphicurl = $_FILES["file"]["name"];
    
    $strippedname = preg_replace('/\s+/', '', $name);
    $feedURL = strtolower($strippedname) . ".xml";
    
    
    if($_FILES["file"]["name"] != null){

            $allowedExts = array("gif", "jpg", "png");
            $extension = end(explode(".", $_FILES["file"]["name"]));
            if (($_FILES["file"]["size"] < 5368709)
            && in_array($extension, $allowedExts))
              {
              if ($_FILES["file"]["error"] > 0)
                {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                }
              else
                {
                echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                echo "Type: " . $_FILES["file"]["type"] . "<br />";
                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
                echo "<br />";
                echo "<b>Please wait.  Updating the Roku XML on S3...</b>";

                $s3->putObjectFile($_FILES["file"]["tmp_name"], $bucketName, baseName($_FILES["file"]["name"]), S3::ACL_PUBLIC_READ);

                  
                }
              }
            else
              {
              echo "Invalid file";
              }
              
            }

    
$con = mysql_connect($util->getDatabasePath(),$util->getDatabaseUser(),$util->getDatabasePass());
    
            if (!$con)
            {
            die('Could not connect: ' . mysql_error());
            }

            mysql_select_db($util->getDatabaseName(), $con);

            mysql_query("INSERT INTO series (seriesname, description, startdate, enddate, feedURL, imageurl, createdBy, createdDate, enabled)
                        VALUES ('$name', '$description', '$startdate', '$enddate', '$feedURL', '$graphicurl', '$user', CURDATE(), true);");
            
           
            
            print '<script language="Javascript">document.location.replace("success.php");</script>';

?>
