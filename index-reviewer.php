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
	<script type="text/javascript" src="js/reviewer-swap_pages.js"></script>  
	
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
    <li class="topfirst"><a href="#"  onclick= "return false" onmousedown="javascript:swapContent('reviewed');" style="height:14px;line-height:14px;">Reviewed Proposals</a></li>
    <li class="topfirst"><a href="#" onclick= "return false" onmousedown="javascript:swapContent('pending');" style="height:14px;line-height:14px;">Pending Proposals</a></li>
    <li class="toplast"><a href="#" onclick= "return false" onmousedown="javascript:swapContent('others');" style="height:14px;line-height:14px;">Other Proposals</a></li>
</ul> 
</div> <!--menu-->

<div id = "container" style="width:1150px">

	<!--Just printing out white spaces hehe-->
	<?php
		//echo "<div id=\"viewtype\">";
        echo '<div id="sidebar" align:"center">';
		echo "<label><h2><em>&nbsp;Reviewed Proposals</em></h2></label>";
        //echo "<ul id=\"category_menu\" class=\"MenuBarVertical\">";
		echo '<ul class = "sidebar">';	
		
		echo "<li><a href=\"#\" onclick=\"return false\" onmousedown=\"javascript:swapReviewedContent('all');\">All</a></li>";
		
		echo "<li><a href=\"#\" onclick=\"return false\" onmousedown=\"javascript:swapReviewedContent('approved');\">Approved</a></li>";
		
		echo "<li><a href=\"#\" onclick=\"return false\" onmousedown=\"javascript:swapReviewedContent('disapproved');\">Disapproved</a></li>";
		

        echo " </ul>";
        echo "</div>";
        echo "<!--END OF viewtype ID-->";
		
		echo "<div id=\"view\">";
        echo "<blockquote><small>View your proposals by clicking on the menu on the left.</small></blockquote>"; 
        echo "</div> <!--END OF view ID-->";	
		
		
		echo "<script type=\"text/javascript\">";
		echo "var MenuBar2 = new Spry.Widget.MenuBar(\"category_menu\", {imgRight:\"SpryAssets/SpryMenuBarRightHover.gif\"});";
    	echo "</script>";
	?>
</div> <!--container-->



</body>

</html>
