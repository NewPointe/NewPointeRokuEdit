<?php require 'dpnd/utils.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            
        <?php require 'dpnd/jsDepend.php'; ?>
            
        <script>
            $(function() { $( "#formStartdate" ).datepicker({ dateFormat: 'yy-mm-dd' }); });
            $(function() { $( "#formEnddate" ).datepicker({ dateFormat: 'yy-mm-dd' }); });
        </script>
                    
        <title>Roku Edit</title>
    </head>
    <body onload="setUpForm(['formName','formDescription','formStartdate','formEnddate']);">
        <?php require 'dpnd/Header.php'; ?>

        <div id="mainBodyArea">

            <h2>Add A Series</h2>
            
            <br />
            <div class="styledForm">
                <form name="addseries" action="addSeriesAction.php" method="POST" enctype="multipart/form-data" onsubmit="return validateAllInput(['formName','formDescription','formStartdate','formEnddate', 'picInInputPannel']);">
                    <table>
                        <tr>
                            <td class="td1">
                                <label>Name
                                    <span class="small">The name of the series.</span>
                                </label>
                                <input type="text" id="formName" class="in" size="30" />

                                <label>Description
                                    <span class="small">A short description of the series.</span>
                                </label>
                                <textarea id="formDescription" class="in" rows="4" cols="20"></textarea>

                                <label>Start Date
                                    <span class="small">The beginning of the series.</span>
                                </label>
                                <input type="text" id="formStartdate" class="in" />

                                <label>End Date
                                    <span class="small">The end of the series.</span>
                                </label>
                                <input type="text" id="formEnddate" class="in" />

                            </td>
                            <td class="td2">
                                
                                <div id="picIn" style="clear:both"></div>
                                <script type="text/javascript"> newFileInStyle("picIn", "Add an Image", "image/*"); </script>
                                <br />
                                <input type="submit" class="btn" value="Add Series" />
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