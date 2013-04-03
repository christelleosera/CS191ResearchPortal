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
		//echo "under_review";
		viewUnderReview($user_id);
	}
	
	
	function viewAll($user_id){
		$sql = "SELECT DISTINCT P.title, P.proposal_id
				FROM proposals P
				WHERE P.title NOT IN(SELECT title
				FROM proposals natural join evaluation 
				WHERE user_id = $user_id)"; 
		
		$result = mysql_query($sql);
		
		//get number of result data
		$num_results = mysql_num_rows($result); 
		
		if ($num_results > 0){ 
		
			echo "<table class=\"CSSTableGenerator\" >";
			echo "<tr>";
			echo "<td>#</td>";
			echo "<td>Title</td>";
			echo "<td>Proponent/s</td>";
			echo "</tr>";
			//echo "<caption>List of All Proposals</caption>";
			echo "<thead>";
			echo "<tr></tr>";
			echo "</thead>";
			echo "<tbody>";	
			
			$j = 1;
		
			while($proposal = mysql_fetch_array($result)) {
					$title = $proposal ['title'];
					$p_id = $proposal ['proposal_id'];
					
					echo "<tr>";
					echo "<th align=\"center\">$j </th>";
					echo "<th align=\"center\">$title";
					echo ' <input type="image" title="More About This Proposal" src="img/more.png"';
					echo "onclick=\"return false\" 
							onmousedown=\"javascript:swapProposalContent('$p_id', 'others', 'all');\"/></th>";
					//echo "</tr>";
					
					
						
					$sql = "SELECT proposal_id, last_name, first_name, middle_name 
							FROM users natural join user_proposal
							WHERE proposal_id = $p_id"; 
		
					$proponents = mysql_query($sql);
		
					//get number of result data
					$num_proponents = mysql_num_rows($result); 	
					
					//echo "<tr>";
					echo "<th align=\"center\">";
					
					$i = 1;
					
					while($row = mysql_fetch_array($proponents)){
						
						$first_name = $row['first_name'];
						$last_name = $row['last_name'];
						$middle_name = $row['middle_name'];
						
						$name = $first_name." ".$middle_name." ".$last_name;
						
						echo $name;
						
						$i++;
						if($i != $num_proponents){
							echo ",";
						}
												
					}
					echo "</th>";
					echo "</tr>";
					
					$j++;
						
			}
			
			echo "</tbody>";
			echo "</table>";
		}
		else{
			echo "<p>No proposals found under this filter</p>";			
		}
			
			
		
	}
	
	function viewApproved($user_id){
		$sql = "SELECT DISTINCT P.title, P.proposal_id
				FROM proposals P
				WHERE P.status = 1 and P.title NOT IN(SELECT title
				FROM proposals natural join evaluation 
				WHERE user_id = $user_id) "; 
		
		$result = mysql_query($sql);
		
		//get number of result data
		$num_results = mysql_num_rows($result); 
		
		if ($num_results > 0){ 
		
			echo "<table class=\"CSSTableGenerator\" >";
			echo "<tr>";
			echo "<td>#</td>";
			echo "<td>Title</td>";
			echo "<td>Proponent/s</td>";
			echo "</tr>";
			//echo "<caption>List of All Proposals</caption>";
			echo "<thead>";
			echo "<tr></tr>";
			echo "</thead>";
			echo "<tbody>";	
			
			$j = 1;
		
			while($proposal = mysql_fetch_array($result)) {
					$title = $proposal ['title'];
					$p_id = $proposal ['proposal_id'];
					
					echo "<tr>";
					echo "<th align=\"center\">$j </th>";
					echo "<th align=\"center\">$title";
					echo ' <input type="image" title="More About This Proposal" src="img/more.png"';
					echo "onclick=\"return false\" 
							onmousedown=\"javascript:swapProposalContent('$p_id', 'others', 'approved');\"/></th>";
					//echo "</tr>";
					
					
						
					$sql = "SELECT proposal_id, last_name, first_name, middle_name 
							FROM users natural join user_proposal
							WHERE proposal_id = $p_id"; 
		
					$proponents = mysql_query($sql);
		
					//get number of result data
					$num_proponents = mysql_num_rows($result); 	
					
					//echo "<tr>";
					echo "<th align=\"center\">";
					
					$i = 1;
					
					while($row = mysql_fetch_array($proponents)){
						
						$first_name = $row['first_name'];
						$last_name = $row['last_name'];
						$middle_name = $row['middle_name'];
						
						$name = $first_name." ".$middle_name." ".$last_name;
						
						echo $name;
						
						$i++;
						if($i != $num_proponents){
							echo ",";
						}
												
					}
					echo "</th>";
					echo "</tr>";
					
					$j++;
						
			}
			
			echo "</tbody>";
			echo "</table>";
		}
		else{
			echo "<p>No proposals found under this filter</p>";			
		}
			
		
	}
	
	function viewDisapproved($user_id){
		$sql = "SELECT DISTINCT P.title, P.proposal_id
				FROM proposals P
				WHERE P.status = 2 and P.title NOT IN(SELECT title
				FROM proposals natural join evaluation 
				WHERE user_id = $user_id) "; 
		
		$result = mysql_query($sql);
		
		//get number of result data
		$num_results = mysql_num_rows($result); 
		
		if ($num_results > 0){ 
		
			echo "<table class=\"CSSTableGenerator\" >";
			echo "<tr>";
			echo "<td>#</td>";
			echo "<td>Title</td>";
			echo "<td>Proponent/s</td>";
			echo "</tr>";
			//echo "<caption>List of All Proposals</caption>";
			echo "<thead>";
			echo "<tr></tr>";
			echo "</thead>";
			echo "<tbody>";	
			
			$j = 1;
		
			while($proposal = mysql_fetch_array($result)) {
					$title = $proposal ['title'];
					$p_id = $proposal ['proposal_id'];
					
					echo "<tr>";
					echo "<th align=\"center\">$j </th>";
					echo "<th align=\"center\">$title";
					echo ' <input type="image" title="More About This Proposal" src="img/more.png"';
					echo "onclick=\"return false\" 
							onmousedown=\"javascript:swapProposalContent('$p_id', 'others', 'disapproved');\"/></th>";
					//echo "</tr>";
					
					
						
					$sql = "SELECT proposal_id, last_name, first_name, middle_name 
							FROM users natural join user_proposal
							WHERE proposal_id = $p_id"; 
		
					$proponents = mysql_query($sql);
		
					//get number of result data
					$num_proponents = mysql_num_rows($result); 	
					
					//echo "<tr>";
					echo "<th align=\"center\">";
					
					$i = 1;
					
					while($row = mysql_fetch_array($proponents)){
						
						$first_name = $row['first_name'];
						$last_name = $row['last_name'];
						$middle_name = $row['middle_name'];
						
						$name = $first_name." ".$middle_name." ".$last_name;
						
						echo $name;
						
						$i++;
						if($i != $num_proponents){
							echo ",";
						}
												
					}
					echo "</th>";
					echo "</tr>";
					
					$j++;
						
			}
			
			echo "</tbody>";
			echo "</table>";
		}
		else{
			echo "<p>No proposals found under this filter</p>";			
		}
			
		
	}
	
	function viewUnderReview($user_id){
		$sql = "SELECT DISTINCT P.title, P.proposal_id
				FROM proposals P
				WHERE P.status = 0 and P.title NOT IN(SELECT title
				FROM proposals natural join evaluation 
				WHERE user_id = $user_id) "; 
		
		$result = mysql_query($sql);
		
		//get number of result data
		$num_results = mysql_num_rows($result); 
		
		if ($num_results > 0){ 
		
			echo "<table class=\"CSSTableGenerator\" >";
			echo "<tr>";
			echo "<td>#</td>";
			echo "<td>Title</td>";
			echo "<td>Proponent/s</td>";
			echo "</tr>";
			//echo "<caption>List of All Proposals</caption>";
			echo "<thead>";
			echo "<tr></tr>";
			echo "</thead>";
			echo "<tbody>";	
			
			$j = 1;
		
			while($proposal = mysql_fetch_array($result)) {
					$title = $proposal ['title'];
					$p_id = $proposal ['proposal_id'];
					
					echo "<tr>";
					echo "<th align=\"center\">$j </th>";
					echo "<th align=\"center\">$title";
					echo ' <input type="image" title="More About This Proposal" src="img/more.png"';
					echo "onclick=\"return false\" 
							onmousedown=\"javascript:swapProposalContent('$p_id', 'others', 'under_review');\"/></th>";
					//echo "</tr>";
					
					
						
					$sql = "SELECT proposal_id, last_name, first_name, middle_name 
							FROM users natural join user_proposal
							WHERE proposal_id = $p_id"; 
		
					$proponents = mysql_query($sql);
		
					//get number of result data
					$num_proponents = mysql_num_rows($result); 	
					
					//echo "<tr>";
					echo "<th align=\"center\">";
					
					$i = 1;
					
					while($row = mysql_fetch_array($proponents)){
						
						$first_name = $row['first_name'];
						$last_name = $row['last_name'];
						$middle_name = $row['middle_name'];
						
						$name = $first_name." ".$middle_name." ".$last_name;
						
						echo $name;
						
						$i++;
						if($i != $num_proponents){
							echo ",";
						}
												
					}
					echo "</th>";
					echo "</tr>";
					
					$j++;
						
			}
			
			echo "</tbody>";
			echo "</table>";
		}
		else{
			echo "<p>No proposals found under this filter</p>";			
		}
			
		
	}
	
	
?>
