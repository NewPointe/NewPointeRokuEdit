<?php

$config = array(
    "db" => array(
        "name" => "roku",
        "username" => "root",
        "password" => "nou",
        "host" => "localhost"
    ),
    "S3" => array(
        "prefix" => "http://localhost/RokuEdit/xml/",
        "accessKey" => "nou",
        "secretKey" => "nou",
        "bucketName" => "NewPointeRoku/" //end in slash
    )
);

function getMessageArchive() {

    $messageArray = array();
    $config = $GLOBALS['config'];

    $con = mysql_connect($config['db']['host'], $config['db']['username'], $config['db']['password']);

    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db($config['db']['name'], $con);

    $result = mysql_query("SELECT * FROM series order by enddate DESC;");

    while ($row = mysql_fetch_array($result)) {
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

        echo "<table>";

        //get all messages in series
        $result2 = mysql_query("SELECT * FROM message WHERE series_id = '$seriesid';");

        while ($row = mysql_fetch_array($result2)) {
            $numberofmessages++;

            $messageid = $row["id"];
            $messagename = $row["name"];
            $date = $row["date"];
            $communicator = $row["communicator"];
            $description = $row["description"];
            $runtime = $row["runtime"];
            $fileurl = $row["fileurl"];


            echo "<tr><td>$messagename</td><td>$date</td><td>$communicator</td></tr>";
        }


        echo "</table><br />";
    }

    mysql_close($con);
}

function getSeriesList() {

    $config = $GLOBALS['config'];

    $con = mysql_connect($config['db']['host'], $config['db']['username'], $config['db']['password']);

    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db($config['db']['name'], $con);

    $result = mysql_query("SELECT * FROM series where enabled = true ORDER BY endDate DESC;");

    while ($row = mysql_fetch_array($result)) {

        echo '<option value="' . $row["id"] . '">' . $row["seriesname"] . '</option>';
    }

    mysql_close($con);

}
function uploadFile($fileToUpload, $allowedExts, $s3, $bucketName) {
    if ($fileToUpload["name"] != null) {

        //$allowedExts = array("mp4", "mov");

        $extension = end(explode(".", $fileToUpload["name"]));

        if (($fileToUpload["size"] < 5368709120000000) && in_array($extension, $allowedExts)) {

            if ($_FILES["file"]["error"] > 0) {
                echo "<b>There was an error proccessing this file:</b><br />";
                echo "Error Code: " . $fileToUpload["error"] . "<br />";
                echo "<br />";
                echo "File Name: " . $fileToUpload["name"] . "<br />";
                echo "Type: " . $fileToUpload["type"] . "<br />";
                echo "Size: " . ($fileToUpload["size"] / 1024) . " Kb<br />";
                echo "Temp File: " . $fileToUpload["tmp_name"] . "<br />";
            } else {
                echo "<b>The file was recived successfully!</b><br />";
                echo "<br />";
                echo "File Name: " . $fileToUpload["name"] . "<br />";
                echo "Type: " . $fileToUpload["type"] . "<br />";
                echo "Size: " . ($fileToUpload["size"] / 1024) . " Kb<br />";
                echo "Temp file: " . $fileToUpload["tmp_name"] . "<br />";
                echo "<br />";
                echo "<b>Uploading file to S3...</b>";
                echo "...<br />";
                echo "...<br />";

                $s3->putObjectFile($fileToUpload["tmp_name"], $bucketName, baseName($fileToUpload["name"]), S3::ACL_PUBLIC_READ);
                
                echo "...<br />";
                echo "<b>File uploaded successfully!</b>";
                echo "<br />";
            }
        } else {
                echo "<b>There was an error proccessing this file:</b><br />";
                echo "Error: File is to large or in an unsupported format!<br />";
                echo "<br />";
                echo "File Name: " . $fileToUpload["name"] . "<br />";
                echo "Type: " . $fileToUpload["type"] . "<br />";
                echo "Size: " . ($fileToUpload["size"] / 1024) . " Kb<br />";
                echo "Temp File: " . $fileToUpload["tmp_name"] . "<br />";
        }
    }
}

?>
