<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of util
 *
 * @author bwitting
 */
class util {
    
    
    
    private $databasePath = "127.0.0.1";
    private $databaseUser = "root";
    private $databasePass = "nou";
    private $databaseName = "roku";
    
    private $feedPrefix = "http://localhost/roku/xml/";
    private $awsAccessKey = "nou";
    private $awsSecretKey = "nou";
    private $bucketName = "NewPointeRoku/"; //end in slash
    
    
    
    public function getDatabasePath(){
        return $this->databasePath;
    }
    
    public function getDatabaseUser(){
        return $this->databaseUser;
    }
    
    public function getDatabasePass(){
        return $this->databasePass;
    }
    
    public function getDatabaseName(){
        return $this->databaseName;
    }
    
    public function getFeedPrefix(){
        return $this->feedPrefix;
    }
    
    public function getAwsAccessKey(){
        return $this->awsAccessKey;
    }
    
    public function getAwsSecretKey(){
        return $this->awsSecretKey;
    }
    
    public function getBucketName(){
        return $this->bucketName;
    }
                             
}

?>
