<?php require 'dpnd/utils.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <?php require 'dpnd/jsDepend.php'; ?>
        
        <title>Roku Edit</title>
    </head>
    <body>
        <?php require 'dpnd/Header.php'; ?>
        
        <br />
        
        <div id="mainBodyAdd">
            <div id="mainBodyAddLeft" class="mainBodyAddSect">
                
                <h2>Add A Message<br /></h2>
                <p class="add"><a href="addMessage.php">Add Message</a></p>
                
            </div>
            
            <div id="mainBodyAddRight" class="mainBodyAddSect">
                
                <h2>Add A Series<br /></h2>
	        <p class="add"><a href="addSeries.php">Add Series</a></p>
                
            </div>
        </div>
        
        <div id="mainBodyArea" style="margin: 160px auto 10px;">
            
            
            <h2>Current Roku Message Archive:   <a href="#">Edit</a></h2>
            
            
            <?php getMessageArchive(); ?>
            
            
        </div>
        
         <?php require 'dpnd/Footer.php'; ?>
    </body>
</html>
