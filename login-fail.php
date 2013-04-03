<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--CSS for Menu Bar. Insert this in all of the pages.-->
<link href="css/index.css" rel="stylesheet" type="text/css" />
<!--CSS for the Index Page. Use this for the layout of the other pages.-->
<link href="CSS3 Menu_files/css3menu1/style.css" rel="stylesheet" type="text/css" />
<!--Javascript files for dynamic page swapping-->	
<script type="text/javascript" src="js/jQuery-1.8.2.js"></script>
<script type="text/javascript" src="js/proponent-swap_pages.js"></script>  
<title>UPD DCS Research Submission Portal</title>
</head>

<!--This is where the banner is placed.-->
<div id = "header">
	<div id = "banner">
   	  <img src="img/banner.png"/>
 	</div>
    
    <div id = "login_form">
<!--Log-in Form-->
        <table>
         <form action="checklogin.php" method="post">
           <tr><input type="text" class="input_fields" 
            	onFocus="if(this.value=='Enter username')this.value=''" onblur="if(this.value=='')this.value='Enter username'" 
                name="username" value="Enter username"/></tr>
            <tr><input type="password" class="input_fields"
            	onFocus="if(this.value=='Enter password')this.value=''" onblur="if(this.value=='')this.value='Enter password'"
            	name="password" value="Enter password"/><p/></tr>
            <tr>
                <input type="image" title="Log-in" src="img/login-button.png" name="login-button" alt="submit"  height="22px"/>
                &nbsp;&nbsp;&nbsp;
                <input type="image" title="Cancel" src="img/cancel-button.png" name="cancel-button" alt="reset" height="22px"/>
            </tr>
            <tr>
    	    	<td><span style="color:#C06" style="font-style:italic">Incorrect username and password combination.</span></td>
   		    </tr>
         </form>
        </table>
    </div> 
     
</div>

<body>

<div id = "menu">
<!--
	This is the Menu Bar. If you want to add more options, use this format:
 	<li class="topfirst"><a href="page.php" style="height:14px;line-height:14px;">Option</a></li>
-->
</div> <!--menu-->
<h1><center>All Approved Research Proposals</center></h1>
<div id = "container" style="width:1150px">
    
	<?php
		include 'mysql_connect.php';
		
		$sql = "SELECT * FROM proposals WHERE status = 1";
		$result = mysql_query($sql);
		
		//get number of result data
		$num_results = mysql_num_rows($result); 
		
		if ($num_results > 0){ 
		
			echo '<table class="CSSTableGenerator">';
			//echo "<caption>List of All Proposals</caption>";
			echo "<tr>";
			echo "<td>#</td>";
			echo "<td>Title </td>";
			echo "<td>Main Proponent</td>";
			echo "<td>Co-Proponent/s</td>";
			echo "</tr>";	
			
			$j = 1;
		
			while($proposal = mysql_fetch_array($result)) {
					$title = $proposal ['title'];
					$p_id = $proposal ['proposal_id'];
					
					echo "<tr>";
					echo "<td style=\"text-align:center\">$j</td>";
					echo "<td>$title";
					echo ' <input type="image" title="More About This Proposal" src="img/more.png"';
					echo "onclick=\"return false\" 
							onmousedown=\"javascript:swapProposalContent('$p_id', 'general', 'all');\"/></td>";
					
					//print main proponent
					
						
					$sql = "SELECT proposal_id, last_name, first_name, middle_name 
							FROM users natural join user_proposal
							WHERE proposal_id = $p_id and isMainProponent = 1"; 
		
					$main_proponent = mysql_query($sql);
		
					//get number of result data
					$count = mysql_num_rows($main_proponent); 	
					
					echo "<td>";
					if($count == 1){
						
						while($row = mysql_fetch_array($main_proponent)){
							
							$first_name = $row['first_name'];
							$last_name = $row['last_name'];
							$middle_name = $row['middle_name'];
							
							$name = $first_name." ".$middle_name." ".$last_name;
							
							echo $name;
							
						}
					}
					echo "</td>";
					
					
					//print co-proponents	
					$sql = "SELECT proposal_id, last_name, first_name, middle_name 
							FROM users natural join user_proposal
							WHERE proposal_id = $p_id and isMainProponent = 0"; 
		
					$proponents = mysql_query($sql);
		
					//get number of result data
					$num_proponents = mysql_num_rows($result); 	
					
					echo "<td>";
					
					$i = 1;
					
					while($row = mysql_fetch_array($proponents)){
						
						$first_name = $row['first_name'];
						$last_name = $row['last_name'];
						$middle_name = $row['middle_name'];
						
						$name = $first_name." ".$middle_name." ".$last_name;
						
						echo $name;
						
						$i++;
						
						if($i < $num_proponents){
							echo ",";
						}
						
					}
					echo "</td>";
					
					echo "</tr>";
					
					$j++;
						
			}
		}
	?>
    </table>
</div> <!--container-->

</body>
</html>
