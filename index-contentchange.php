<?php
	include "mysql_connect.php";
	
	$proposal_id = $_POST['contentVar'];
	
	if($proposal_id == "back") {
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
							onmousedown=\"javascript:swapIndexContent('$p_id');\"/></td>";
					
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
	}
	
	else {
		$sql = "SELECT title, abstract, funding_request, start_date, end_date, status
					FROM proposals 
					WHERE proposal_id = '$proposal_id'"; 
			
		$result = mysql_query($sql);
			
		//get number of result data
		$num_results = mysql_num_rows($result); 
			
		if ($num_results = 1){
			
				echo "<table style=\"padding:10px\">";
				//echo "<caption>List of All Proposals</caption>";
				echo "<thead>";
				echo "<tr></tr>";
				echo "</thead>";
				echo "<tbody>";	
				
				$proposal = mysql_fetch_array($result);
				
				$title = $proposal ['title'];
				$abstract = $proposal ['abstract'];
				$funding = $proposal['funding_request'];
				$start_date = $proposal ['start_date'];
				$end_date = $proposal['end_date'];
				$status = $proposal ['status'];
				
				echo "<tr>";
				echo "<th>Title</th>";	
				echo "<td>:</td>";	
				echo "<td>$title</td>";			
				echo "</tr>";	
				
				echo "<tr>
				  <td></td>
				  <td></td>
				  <td></td>
				  </tr>";
				
				echo "<tr>";
				echo "<th>Abstract</th>";
				echo "<td>:</td>";	
				echo "<td>$abstract</td>";			
				echo "</tr>";	
				
				echo "<tr>
				  <td></td>
				  <td></td>
				  <td></td>
				  </tr>";
				
				echo "<tr>";
				echo "<th>Funding Requested</th>";
				echo "<td>:</td>";	
				echo "<td>$funding</td>";			
				echo "</tr>";
				
				echo "<tr>
				  <td></td>
				  <td></td>
				  <td></td>
				  </tr>";
				
				echo "<tr>";
				echo "<th>Proposesd Start Date</th>";
				echo "<td>:</td>";	
				echo "<td>$start_date</td>";			
				echo "</tr>";
				
				echo "<tr>
				  <td></td>
				  <td></td>
				  <td></td>
				  </tr>";
				
				echo "<tr>";
				echo "<th>Proposed End Date</th>";
				echo "<td>:</td>";	
				echo "<td>$end_date</td>";			
				echo "</tr>";
				
				echo "<tr>
				  <td></td>
				  <td></td>
				  <td></td>
				  </tr>";
				
				echo "<tr>";
				echo "<th>Status</th>";
				echo "<td>:</td>";	
				echo "<td>";
				
				if($status == 0){
					echo "Under Review";				
				}
				else if($status == 1){
					echo "Approved";				
				}
				if($status == 2){
					echo "Disapproved";				
				}
				
				
				echo "</td>";			
				echo "</tr>";			
					
				echo "</tbody>";
				echo "</table>";			
		}
		else{
			echo "Can't retrieve your proposal";
		}
		echo '<center>';
		echo "<input type=\"image\" src=\"img/back.png\" style=\"padding-bottom:10px\" onclick=\"return 		
									  false\" onmousedown=\"javascript:swapIndexContent('back');\"/>";	
		echo '</center>';
	}
	
		
?>