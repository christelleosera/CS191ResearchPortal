<?php

	include "mysql_connect.php";
	
	$proposal_id = $_POST['propIDVar'];
	$viewtype = $_POST['viewtypeVar'];
	$back_to = $_POST['backtoVar'];
	
	$sql = "SELECT title, abstract, funding_request, start_date, end_date, status
			    FROM proposals 
				WHERE proposal_id = '$proposal_id'"; 
		
	$result = mysql_query($sql);
		
	//get number of result data
	$num_results = mysql_num_rows($result); 
		
	if ($num_results = 1){
		
			echo "<table id=\"proposal_view\">";
			//echo "<caption>List of All Proposals</caption>";
			echo "<thead>";
			echo "<tr>
				  <td></td>
				  <td></td>
				  <td></td>
			</tr>";
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
			echo "<th width=50px>Funding Requested</th>";
			echo "<td>:</td>";	
			echo "<td>$funding</td>";
			echo "</tr>";
			
			echo "<tr>
				  <td></td>
				  <td></td>
				  <td></td>
				  </tr>";
			
			echo "<tr>";
			echo "<th>Proposed Start Date</th>";
			echo "<td>:</td>";	
			echo "<td>$start_date</td>";
			echo "<td></td>";	
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
			
			echo "<tr>";
			echo "<th>Download link:</th>";
			
			$sql = "SELECT filename
			        FROM proposal_file 
				    WHERE proposal_id = '$proposal_id'"; 
		
			$proposal_file = mysql_query($sql);
		
			//get number of result data
			$num_file = mysql_num_rows($proposal_file); 
			
			if($num_file == 1){
				$row = mysql_fetch_array($proposal_file);
				$filename = $row['filename'];
				echo "<td><a href=\"proposals/".$filename."\"";
				echo 'title="Download the pdf file" target="_blank">PDF file</a></td>';
			}
			else{
				echo 'Sorry file not available for download.';
			}
			echo "</tr>";
				
			echo "</tbody>";
			echo "</table>";			
	}
	else{
		echo "Can't retrieve your proposal";
	}
	
	echo ' <input type="image" title="Back" src="img/back.png"';
	echo "onclick=\"return false\"";
	if($viewtype == "general"){
		echo "onmousedown=\"javascript:swapContent('others');\" /></td>";
	}
	else{
		echo "onmousedown=\"javascript:swapMyViewContent('$back_to');\"/></td>";
	}
	
	echo '<a href="index-proponent.php"><img src="img/home.png"/></a>';
?>