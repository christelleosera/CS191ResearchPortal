<?php
	include "mysql_connect.php";

	$view_type = $_POST['contentVar'];		
	$user_id = $_COOKIE['user_id'];
	
	if($view_type == "all"){
		viewAll($user_id);
	}
	else if($view_type == "approved"){
		//echo "approved";
		viewApproved($user_id);
	}
	else if($view_type == "disapproved"){
		//echo "disapproved";
		viewDisapproved($user_id);
	}
	else if($view_type == "under_review"){
		//echo "under review";
		viewUnderReview($user_id);
	}
	
	/*view all proposals which user is a proponent of*/	
	
	function viewAll($user_id){
		$sql = "SELECT DISTINCT title, proposal_id
			    FROM user_proposal natural join proposals 
				WHERE user_id = '$user_id'"; 
		
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
							onmousedown=\"javascript:swapProposalContent('$p_id' , 'myview', 'all');\"/></td>";
					
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
					$num_proponents = mysql_num_rows($proponents); 	
					
					echo "<td>";
					
					$i = 0;
					//echo $num_proponents.'<br>';
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
	
	/*view all approved proposals which user is a proponent of*/
	
	function viewApproved($user_id){
		
		$sql = "SELECT DISTINCT title, proposal_id
			    FROM user_proposal natural join proposals 
				WHERE user_id = '$user_id' AND status = 1"; 
		
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
							onmousedown=\"javascript:swapProposalContent('$p_id', 'myview', 'approved');\"/></td>";
					
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
					$num_proponents = mysql_num_rows($proponents); 	
					
					echo "<td>";
					
					$i = 0;
					
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
	
	/*view all disapproved proposals which user is a proponent of*/
	
	function viewDisapproved($user_id){
		
		$sql = "SELECT DISTINCT title, proposal_id
			    FROM user_proposal natural join proposals 
				WHERE user_id = '$user_id' AND status = 2"; 
		
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
							onmousedown=\"javascript:swapProposalContent('$p_id', 'myview', 'disapproved');\"/></td>";
					
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
					$num_proponents = mysql_num_rows($proponents); 	
					
					echo "<td>";
					
					$i = 0;
					
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
	
	/*view all under review proposals which user is a proponent of*/
	
	function viewUnderReview($user_id){
		
		$sql = "SELECT DISTINCT title, proposal_id
			    FROM user_proposal natural join proposals 
				WHERE user_id = '$user_id' AND status = 0"; 
		
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
							onmousedown=\"javascript:swapProposalContent('$p_id', 'myview', 'under_review');\"/></td>";
					
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
					$num_proponents = mysql_num_rows($proponents); 	
					
					echo "<td>";
					
					$i = 0;
					
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