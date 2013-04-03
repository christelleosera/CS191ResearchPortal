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
    <li class="topfirst"><a href="#"  onclick= "return false" onmousedown="javascript:swapContent('myproposals');" 
    					style="height:14px;line-height:14px;">Home</a></li>
    <li class="topfirst"><a href="#" onclick= "return false" onmousedown="javascript:swapContent('others');" 
    					style="height:14px;line-height:14px;">All Proposals</a></li>
    <li class="topfirst"><a href="#" onclick= "return false" onmousedown="javascript:swapContent('createproposal');" 
    					style="height:14px;line-height:14px;">Create Proposal</a></li>
</ul> 
</div> <!--menu-->

<div id = "container" width="1150px">
   
    <div id="createproposal"><h2></h2>
		<table width="100%">
		<form enctype="multipart/form-data" action="proponent-create_response.php" method="POST">
			<tr><strong>
            		<span style="color:#C06" style="font-style:italic"> 
            		Ooops! There seems to be a problem!
					<?php 
						session_start();
						if($_SESSION['lack_err'] == 1){
							echo "You forgot some fields!";
						}
					?>
                    </strong></tr>
			<tr>
				<td>
                    Co-proponent/s:</td>
				<td>:</td>
				<td>
				<?php 
					printUsers();
				?>						
				</td>
                <td>
                	<?php	
							if($_SESSION['co_prop_err'] ==1){
								echo '<img src="img/x_small.png"/>';
								echo '<span style="color:#C06" style="font-style:italic"> '; 
								echo "You seem to have repeated a co-proponent's name.";
							}
							/*else{
								echo '<img src="img/check_small.png"/>';
							}*/
                	?>
                </td>
			</tr>
			<tr>
				<td>Research Title:</td>
				<td>:</td>
				<td><input type="text" name="title" maxlength="50" value=
					<?php
						$title = $_SESSION['title'];
						echo "\"$title\"";
					?> /></td>
                <td> 
                    <?php 
						if($_SESSION['title_set'] != 1){
							echo '<img src="img/x_small.png"/>';								
							echo '<span style="color:#C06" style="font-style:italic"> '; 
							echo "What's your proposal's title?";
						}
						/*changed*/
						else{
							echo '<img src="img/check_small.png"/>';
						}
					?>              
                </td>
			</tr>
			<tr>
				<td>Research Abstract:</td>
				<td>:</td>
				<td><textarea name="abstract" rows="10" cols="48"maxlength="2000"onfocus="clearContents(this);"><?php
						$abstract = $_SESSION['abstract'];
						/*edited*/
						if($abstract == ""){
							echo "Abstract Here</textarea>";
						}
						else{
							echo "$abstract</textarea>";
						}
					?>
                   </td>
                <td>
                 <?php 
					if($_SESSION['abstract_set'] != 1){
						echo '<img src="img/x_small.png"/>';								
						echo '<span style="color:#C06" style="font-style:italic"> '; 
						echo "Put an abstract to give an overview of your proposal";
					}
				?>                  
                </td>
			</tr>
			<tr>
				<td>Research Proposal File:</td>
				<td>:</td>
				<td><input type="file" id="proposal" name="proposal" /></td>
                 <td>
                	<?php	
							if($_SESSION['proposal_set'] != 1){
								echo '<img src="img/x_small.png"/>';								
								echo '<span style="color:#C06" style="font-style:italic"> '; 
								echo "The pdf of your proposal was missing.";
							}
							else if($_SESSION['file_err'] ==1){
								echo '<img src="img/x_small.png"/>';								
								echo '<span style="color:#C06" style="font-style:italic"> '; 
								echo " You can only upload pdf files.";
							}
							else{
								echo '<img src="img/check_small.png"/>';
							}
                	?>
                   
                </td>
			</tr>
			<tr>
				<td>Fund Requested:</td>
				<td>:</td>
				<td><input type="text" name="fund" maxlength="20" value=
					<?php
						$fund = $_SESSION['fund'];
						echo "\"$fund\"";
					?>/></td>
                 <td>
                	<?php	
							if($_SESSION['fund_set'] != 1){
								echo '<img src="img/x_small.png"/>';								
								echo '<span style="color:#C06" style="font-style:italic"> '; 
								echo "How much funding do you want?";
							}
							else if($_SESSION['fund_err'] ==1){
								echo '<img src="img/x_small.png"/>';
								echo '<span style="color:#C06" style="font-style:italic"> '; 
								echo "You can only enter a numeric value for your funding request.";
							}
							else{
								echo '<img src="img/check_small.png"/>';
							}
                	?>
                    
                </td>
			</tr>
				<tr>
				<td>Start Date:</td>
				<td>:</td>
				<td><input type="text" name="start_date" maxlength="20" id="start_date" onclick= "return false" 			     onmousedown="javascript:getDate('start');"
                value=
					<?php
						$start_date = $_SESSION['start_date'];
						echo "\"$start_date\"";
					?>
                
                /></td>
                 <td>
                	<?php	
							if($_SESSION['start_date_set'] != 1){
								echo '<img src="img/x_small.png"/>';								
								echo '<span style="color:#C06" style="font-style:italic"> '; 
								echo "Pick a start date.";
							}	
							/*edited*/				
							else if($_SESSION['date_err'] ==1){
								/*edited*/
								echo '<img src="img/x_small.png"/>';	
								echo '<span style="color:#C06" style="font-style:italic"> '; 
								echo "There seems to be a conflict with your start and end date.";
							}
							else{
								echo '<img src="img/check_small.png"/>';
							}
                	?>
                    
                </td>
			</tr>
				<tr>
				<td>End Date:</td>
				<td>:</td>
				<td><input type="text" name="end_date" maxlength="20" id="end_date" onclick= "return false" 			     onmousedown="javascript:getDate('end');"
                 value=
					<?php
						$end_date = $_SESSION['end_date'];
						echo "\"$end_date\"";						
					?>
                
                /></td>
                 <td>
                 	<?php
                 			if($_SESSION['end_date_set'] != 1){
								echo '<img src="img/x_small.png"/>';								
								echo '<span style="color:#C06" style="font-style:italic"> '; 
								echo "Pick an end date.";
							}
							/*edited*/					
							else if($_SESSION['date_err'] ==1){
								echo '<img src="img/x_small.png"/>';
							}
							else{
								echo '<img src="img/check_small.png"/>';
							}
					?>
                 
                </td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><input type="submit" name="createproposal" value="Submit" /><input type="reset" name="cancel" value="Cancel"/></td>
			</tr>
		</form>
		</table>
	</div> <!--END OF createproposal ID-->
</div> <!--container-->

</body>
</html>

<?php
	
	function printUsers(){
		
		for($i = 1; $i <= 3; $i++){
			echo "<select name=co_prop$i>";
			echo "<option value=0>Co-Proponent $i</option>";
			$user_id = $_COOKIE['user_id'];			
						
			$sql = "SELECT user_id, first_name, last_name, middle_name
					FROM users 
					WHERE user_id <> '$user_id'";
			$result = mysql_query($sql);
			$count = mysql_num_rows($result);	
			echo $count;	
			
			while($row = mysql_fetch_array($result)) {
					$fn = $row['first_name'];
					$mn = $row['middle_name'];
					$ln = $row['last_name'];
					$c_id = $row['user_id'];
				
					$name = "$fn "."$mn ". "$ln";
					
					echo "<option value=$c_id>$name</option>";
			}		
			echo "</select>";	
			echo "&nbsp;<p>";
			
		}
	}

?>
