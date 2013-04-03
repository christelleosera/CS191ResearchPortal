<?php
	include "mysql_connect.php";

	$view_type = $_POST['contentVar'];		
		
	if($view_type == "all"){
		viewAll();
	}
	else if($view_type == "approved"){
		//echo "approved";
		viewApproved();
	}
	else if($view_type == "disapproved"){
		//echo "disapproved";
		viewDisapproved();
	}
	else if($view_type == "under_review"){
		//echo "under review";
		viewUnderReview();
	}
	
	/*view all proposals*/	
	
	function viewAll(){
		$sql = "SELECT DISTINCT title, proposal_id
			    FROM user_proposal natural join proposals";
		
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
		else{
			echo "<p>No proposals found under this filter</p>";			
		}
			
		
	}
	
	/*view all approved proposals*/
	
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
							onmousedown=\"javascript:swapProposalContent('$p_id', 'general', 'approved');\"/></td>";
					
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
	
	/*view all disapproved proposals*/
	
	function viewDisapproved(){
		
		$sql = "SELECT DISTINCT title, proposal_id
			    FROM user_proposal natural join proposals 
				WHERE status = 2"; 
		
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
							onmousedown=\"javascript:swapProposalContent('$p_id', 'general', 'disapproved');\"/></td>";
					
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
	
	/*view all under review proposals*/
	
	function viewUnderReview(){
		
		$sql = "SELECT DISTINCT title, proposal_id
			    FROM user_proposal natural join proposals 
				WHERE status = 0"; 
		
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
							onmousedown=\"javascript:swapProposalContent('$p_id', 'general', 'under_review');\"/></td>";
					
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




?>