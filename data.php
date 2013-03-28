<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of data
 *
 * @author bwitting
 */


class data {
    
    private $databasePath = "127.0.0.1";
    private $databaseUser = "root";
    private $databasePass = "nou";
    private $databaseName = "roku";
    
    
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
            
        /**
        * Desc
        */
    
    
    /**
        * Desc
        */
    public function addMessageGetSeries(){
        
                    $return = '';
                    $con = mysql_connect($this->databasePath, $this->databaseUser, $this->databasePass);
                    if (!$con)
                    {
                    die('Could not connect: ' . mysql_error());
                    }

                    mysql_select_db($this->databaseName, $con);

                    $result = mysql_query("SELECT * FROM series where enabled = true ORDER BY endDate DESC;");

                    while($row = mysql_fetch_array($result))
                    {

                    $return .=  '<option value="' . $row["id"] . '">' . $row["seriesname"] . '</option>';

                    }

                    mysql_close($con);
                    
                    
        return $return;
    }
    
    
}

?>
