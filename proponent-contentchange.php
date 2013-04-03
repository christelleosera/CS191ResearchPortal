<?php
	include "mysql_connect.php";
	$content = $_POST['contentVar'];	
	
	if($content == "myproposals"){
		viewmyproposals();
	}
	else if($content == "others"){
		viewApproved();
	}
	
	else if($content == "createproposal"){	
		createproposal();
	}
	
	function createproposal(){
		echo '<div id="createproposal"><h2></h2>
		<table width="50%">
		<form enctype="multipart/form-data" action="proponent-create_response.php" method="POST">
			<tr><strong>Fill in the necessary fields to submit your proposal!</strong></tr>
			<tr>
				<td>Co-proponent/s:</td>
				<td>:</td>
				<td>';
				
		printUsers();		
					
		echo '
				</td>
			</tr>
			<tr>
				<td>Research Title:</td>
				<td>:</td>
				<td><input type="text" name="title" maxlength="50"/></td>
			</tr>
			<tr>
				<td>Research Abstract:</td>
				<td>:</td>
				<td><textarea name="abstract" rows="10" cols="48"maxlength="2000" onfocus="clearContents(this);">Abstract Here</textarea></td>
			</tr>
			<tr>
				<td>Research Proposal File:</td>
				<td>:</td>
				<td><input type="file" id="proposal" name="proposal" /></td>
			</tr>
			<tr>
				<td>Fund Requested:</td>
				<td>:</td>
				<td><input type="text" name="fund" maxlength="20"/></td>
			</tr>
				<tr>
				<td>Start Date:</td>
				<td>:</td>
				<td><input type="text" name="start_date" maxlength="20" id="start_date" onclick= "return false" 			     onmousedown="javascript:getDate(\'start\');"/></td>
			</tr>
				<tr>
				<td>End Date:</td>
				<td>:</td>
				<td><input type="text" name="end_date" maxlength="20" id="end_date" onclick= "return false" 			     onmousedown="javascript:getDate(\'end\');"/></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><input type="submit" name="createproposal" value="Submit" /><input type="reset" name="cancel" value="Cancel"/></td>
			</tr>
		</form>
		</table>
	</div> <!--END OF createproposal ID-->';
		
	}
	
	function viewmyproposals(){
		//echo "<div id=\"viewtype\">";
        echo '<div id="sidebar" align:"center">';
		echo "<label><h2><em>&nbsp;My Proposals</em></h2></label>";
        //echo "<ul id=\"category_menu\" class=\"MenuBarVertical\">";
		echo '<ul class = "sidebar">';	
		
		echo "<li><a href=\"#\" onclick=\"return false\" onmousedown=\"javascript:swapMyViewContent('all');\">All</a></li>";
		
		echo "<li><a href=\"#\" onclick=\"return false\" onmousedown=\"javascript:swapMyViewContent('approved');\">Approved</a></li>";
		
		echo "<li><a href=\"#\" onclick=\"return false\" onmousedown=\"javascript:swapMyViewContent('disapproved');\">Disapproved</a></li>";
		
		echo "<li><a href=\"#\" onclick=\"return false\" onmousedown=\"javascript:swapMyViewContent('under_review');\">Under Review</a></li>";
		

        echo " </ul>";
        echo "</div>";
        echo "<!--END OF viewtype ID-->";
		
		echo "<div id=\"view\">";
        echo "<blockquote><small>View your proposals by clicking on the menu on the left.</small></blockquote>"; 
        echo "</div> <!--END OF view ID-->";	
		
		
		echo "<script type=\"text/javascript\">";
		echo "var MenuBar2 = new Spry.Widget.MenuBar(\"category_menu\", {imgRight:\"SpryAssets/SpryMenuBarRightHover.gif\"});";
    	echo "</script>";
		
		
		
	}
	function viewApproved(){
		
		$sql = "SELECT DISTINCT title, proposal_id
			    FROM user_proposal natural join proposals 
				WHERE status = 1"; 
		
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
					echo "<td>$j </td>";
					echo "<td>$title";
					echo ' <input type="image" title="More About This Proposal" src="img/more.png"';
					echo "onclick=\"return false\" 
							onmousedown=\"javascript:swapGeneralProposalContent('$p_id', 'general', 'approved');\"/></td>";
					
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
		else{
			echo "<p>No proposals found under this filter</p>";				
		}
			
		
	}
	
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