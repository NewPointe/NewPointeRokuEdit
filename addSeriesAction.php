<?php

if (!class_exists('S3'))
    require_once 'dpnd/S3.php';
require 'dpnd/utils.php';


$imageBucketName = $util->getBucketName() . 'images';


$s3 = new S3($util->getAwsAccessKey(), $util->getAwsSecretKey());

$user = "bronson";

$name = $_POST["name"];
$description = $_POST["description"];
$startdate = $_POST["startdate"];
$enddate = $_POST["enddate"];


$graphicurl = $_FILES["file"]["name"];


$strippedname = preg_replace('/\s+/', '', $name);
$feedURL = strtolower($strippedname) . ".xml";

if ($_FILES["file"]["name"] != null) {

    echo "Proccessing file upload.<br />";
    
    $allowedExts = array("gif", "jpg", "png");
    uploadFile($_FILES["file"], $allowedExts, $s3, $imageBucketName);
    
    echo "File uploaded.<br />";
    
}

    echo "Connecting to SQL Database...<br />";
    echo "...<br />";
    echo "...<br />";
    
$con = mysql_connect($config['db']['host'], $config['db']['username'], $config['db']['password']);

if (!$con) {
    die('Error: Could not connect to SQL Database: ' . mysql_error());
}
    echo "Connected to SQL Database.<br />";
    echo "Updating records...<br />";

mysql_select_db($util->getDatabaseName(), $con);

mysql_query("INSERT INTO series (seriesname, description, startdate, enddate, feedURL, imageurl, createdBy, createdDate, enabled)
                        VALUES ('$name', '$description', '$startdate', '$enddate', '$feedURL', '$graphicurl', '$user', CURDATE(), true);");

    echo "Records updated.";

    echo "Updating XML...<br />";
    echo "...<br />";
    echo "You will be redirected in 3 seconds...";
    echo "...<br />";
    echo "...<br />";
    echo "...<br />";
print '<script language="Javascript">document.setTimeout(document.location.replace("updateRokuXML.php"), 5000);</script>';
?>
