<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />




<!-- Add jQuery library -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>


<!-- Add fancyBox -->
<link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.4"></script>
        
        <script type="text/javascript">
$(document).ready(function() {
		$(".fancybox").fancybox();
	});
      
 $(document).ready(function() {
  $("#link").fancybox();
  $("#btn").click(function(){
    $("#link").trigger('click');
  });
});

</script>
        
          <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />

  <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
     <script>
                    $(function() {
                            $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
                    });
                
                $(function() {
                            $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
                    });
                </script>
    
    <title>Add Series</title>


<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="topPan">
	<a href="index.php"><img src="images/newpointe.png" alt="NewPointe" wborder="0" class="logo" title="NewPointe" /></a>
	</div>

<div id="bodyPan">
        
    <h1>Add A Series</h1>
    <br />
        
        <form name = "addseries" action = "addSeriesAction.php" method = "POST" enctype = "multipart/form-data">
            
            
            <table border="0">
                <tbody>
                    <tr>
                        <td>Series Name:</td>
                        <td><input type="text" name="name" value="" size="30" /></td>
                    </tr>
                    <tr>
                        <td>Series Description: </td>
                        <td><textarea name="description" rows="4" cols="20"></textarea></td>
                    </tr>
                    <tr>
                        <td>Start Date:</td>
                        <td><input type="text" name="startdate" value="" id="datepicker"/></td>
                    </tr>
                    <tr>
                        <td>End Date:</td>
                        <td><input type="text" name="enddate" value="" id="datepicker2"/></td>
                    </tr>
                    <tr>
                        <td>Series Image File:</td>
                        <td><input type="file" name="file" id="file" /></td>
                    </tr>
                    <tr>
                        <td><br /></td>
                        <td><br /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" id="btn" value="Add Series" /></td>
                    </tr>
                </tbody>
            </table>


</form>
    
    <div style="display:none;"> 
 <a href="#test" id="link">Click</a>
</div>

<div id="test" style="display:none;">Please wait... Your image is uploading.<br /><br />
    Do not close this window until you see the upload confirmation. </div>
        
	</div>

	
	<div id="footermainPan">
  <div id="footerPan">

		<p class="copyright">Build 27-2.6</p>
  </div>
</div>
</body>
</html>


