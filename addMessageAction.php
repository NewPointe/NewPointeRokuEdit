<?php

if (!class_exists('S3'))
    require_once 'dpnd/S3.php';
require 'dpnd/utils.php';


$sdVideoBucketName = $util['S3']['bucketName'] . 'sdVideos';
$hdVideoBucketName = $util['S3']['bucketName'] . 'hdVideos';

$s3 = new S3($util['S3']['accessKey'], $util['S3']['secretKey']);

$user = "bronson";

$name = $_POST["formName"];
$series = $_POST["formSeries"];
$communicator = $_POST["formCommunicator"];
$date = $_POST["formDate"];
$runtime = $_POST["runtime"];

$fileurl = $_FILES["vidIn1InputPannel"]["name"];
$graphicurl = $_FILES["vidIn1InputPannel"]["name"];

$fileurl2 = $_FILES["vidIn2InputPannel"]["name"];
$graphicurl2 = $_FILES["vidIn2InputPannel"]["name"];

if ($_FILES["vidIn1InputPannel"]["name"] != null
 && $_FILES["vidIn2InputPannel"]["name"] != null) {
    
    uploadFile($_FILES["vidIn1InputPannel"], array("mp4", "mov"), $s3, $sdVideoBucketName);
    uploadFile($_FILES["vidIn2InputPannel"], array("mp4", "mov"), $s3, $hdVideoBucketName);

}


$con = mysql_connect($config['db']['host'], $config['db']['username'], $config['db']['password']);

if (!$con) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db($config['db']['name'], $con);

mysql_query("INSERT INTO message (series_id, name, date, communicator, runtime, fileurl, graphicurl, fileurl2, graphicurl2, createdBy, createdDate, enabled)
                        VALUES ('$series', '$name', '$date', '$communicator',  '$runtime', '$fileurl', '$graphicurl','$fileurl2', '$graphicurl2','$user', CURDATE(), true);");

print '<script language="Javascript">document.location.replace("generateXML.php");</script>';
?>