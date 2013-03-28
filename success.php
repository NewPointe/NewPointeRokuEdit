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
        
    <h1>Success</h1>
    <br />
        Your message or series was successfully uploaded.  <br /><br />
        <a href="index.php">Return to the Home Page</a>
        
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


