<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!--CSS for Menu Bar. Insert this in all of the pages.-->
    <link href="css/index.css" rel="stylesheet" type="text/css" />
    <!--CSS for the Index Page. Use this for the layout of the other pages.-->
    <link href="CSS3 Menu_files/css3menu1/style.css" rel="stylesheet" type="text/css" />
    <!--CSS for the Proponent Pages-->
	<link href="css/proponent_style.css" rel="stylesheet" type="text/css" /> 
    
    
    <title>UPD DCS Research Submission Portal</title>
    

	<!--Javascript files for dynamic page swapping-->	
	<script type="text/javascript" src="js/jQuery-1.8.2.js"></script>
	<script type="text/javascript" src="js/proponent-swap_pages.js"></script>   
    
    <!--JQuery Plugin for Datepicker-->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css" />
    <script type="text/javascript" src="js/proponent-date_picker.js"></script>
    

</head>

<!--This is where the banner is placed.-->
<div id = "header">
	<div id = "banner">
   	  <img src="img/banner.png"/>
 	</div>
    <div id = "login_form">
    Hi, <a href="#" style="text-decoration:none">
    <? include 'mysql_connect.php'; $username = $_COOKIE['username']; echo "$username!" ?>
    </a><br/><a href="index.php" style="text-decoration:none">Not you? Log-out</a>
    </div>
</div> 

<body>

<div id = "menu">
<!--This is the Menu Bar. If you want to add more options, use this format:
 	<li><a href="page.php" style="height:14px;line-height:14px;">Option</a></li>-->
<ul id="css3menu1" class="topmenu">
    <li ><a href="#"  onclick= "return false" onmousedown="javascript:swapContent('myproposals');" style="height:14px;line-height:14px;">Home</a></li>
    <li ><a href="#" onclick= "return false" onmousedown="javascript:swapContent('others');" style="height:14px;line-height:14px;">Other Proposals</a></li>
    <li class="toplast"><a href="#" onclick= "return false" onmousedown="javascript:swapContent('createproposal');" style="height:14px;line-height:14px;">Create Proposal</a></li>
</ul> 
</div> <!--menu-->

<div id = "container">
    <h1><img src="img/success.png"/></h2>
    <a href="index-proponent.php"><img src="img/home.png"/></a>
    <a href="#" onclick= "return false" onmousedown="javascript:swapContent('createproposal');"><img src="img/new_prop.png"/></a>
    
</div> <!--container-->

</body>
</html>
