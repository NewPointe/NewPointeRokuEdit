<?php require 'dpnd/utils.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <?php require 'dpnd/jsDepend.php'; ?>

        <script type="text/javascript">
            
            function init(){
                
                $(".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
                
                setUpForm(['formName','formSeries','formDate','formCommunicator']);
                
                newFileInStyle("vidIn1", "Add a Video", "video/*", 140, 405);
                newFileInStyle("vidIn2", "Add an HD Video", "video/*", 140, 405);
                
        document.getElementById('addMessageForm').setAttribute('onsubmit', "return validateAllInput(['formName','formSeries','formDate','formCommunicator', 'vidIn1InputPannel', 'vidIn2InputPannel'])");
                
            }
            
        </script>

        <title>Roku Edit</title>
    </head>
    <body onload="init();">
        <?php require 'dpnd/Header.php'; ?>


        <div id="mainBodyArea">

            <h2>Add A Message</h2>
            
            <br />
            <div class="styledForm">
                <form id="addMessageForm" name="addmessage" action="addMessageAction.php" method="POST" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td class="td1">
                                <label>Name
                                    <span class="small">The name of the message.</span>
                                </label>
                                <input type="text" id="formName" class="in" size="30" />

                                <label>Series
                                    <span class="small">The series that the message is in.</span>
                                </label>
                                <select id="formSeries" class="in"  >
                                    <?php getSeriesList(); ?>
                                </select>

                                <label>Date
                                    <span class="small">The date of the message.</span>
                                </label>
                                <input type="text" id="formDate" class="in datepicker" />

                                <label>Communicator
                                    <span class="small">The communicator for this message.</span>
                                </label>
                                <input type="text" id="formCommunicator" class="in" />

                            </td>
                            <td class="td2">
                                <div id="vidIn1" style="clear:both"></div>
                                <div id="vidIn2" style="clear:both"></div>
                                <br />
                                <input type="submit" class="btn" value="Add Message" />
                                <div style="clear:both"></div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <?php require 'dpnd/Footer.php'; ?>
    </body>
</html>