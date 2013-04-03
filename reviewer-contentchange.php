<?php
	include "mysql_connect.php";
	$view_type = $_POST['contentVar'];		
	$user_id = $_COOKIE['user_id'];
	
	if($view_type == "reviewed"){
		viewReviewed($user_id);
	}
	else if($view_type == "pending"){
		viewPending($user_id);
	}
	
	else if($view_type == "others"){	
		viewOthers($user_id);
	}
	
	
	function viewReviewed($user_id){
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
		
		
		
	}
	
	function viewPending($user_id){
		
		echo '<div id="sidebar" align:"center">';
		echo "<label><h2><em>&nbsp;Pending Proposals</em></h2></label>";
        echo "</div>";
        echo "<!--END OF viewtype ID-->";
		
		echo "<div id=\"view\">";
        /*$sql = "SELECT DISTINCT title, proposal_id
			    FROM proposals natural join evaluation 
				WHERE user_id = '$user_id' and decision = 3"; */
		// $sql = "SELECT * FROM proposals WHERE status=0 AND proposal_id IN (SELECT proposal_id FROM evaluation WHERE user_id <> '".$user_id."')"; 
		$sql = "SELECT DISTINCT proposal_id FROM (SELECT proposal_id FROM proposals WHERE status=0 UNION SELECT proposal_id FROM EVALUATION WHERE user_id <> ".$user_id." AND decision = 3 UNION SELECT proposal_id FROM user_proposal NATURAL JOIN proposals WHERE user_id<>".$user_id." AND status = 0) as valid WHERE proposal_id NOT IN (SELECT proposal_id FROM evaluation WHERE user_id=$user_id)"; 
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
					$p_id = $proposal ['proposal_id'];
					$sql = "SELECT title FROM proposals WHERE proposal_id='".$p_id."'";
					$title_q = mysql_fetch_array(mysql_query($sql));
					$title = $title_q['title'];
					
					echo "<tr>";
					echo "<th align=\"center\">$j </th>";
					echo "<th align=\"center\">$title";
					echo ' <input type="image" value="More Info" src="img/more.png"';
					echo "onclick=\"return false\" onmousedown=\"javascript:swapProposalContent('$p_id', 'pending', '');\"/>";
					echo '&nbsp;<input type="image" src="img/review.png" value="Review" ';
					echo "onclick=\"return false\" onmousedown=\"javascript:swapReviewProposalContent('$p_id');\"/></th>";
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
			
		
		echo "</div> <!--END OF view ID-->";	
	}
	
	function viewOthers($user_id){
        echo '<div id="sidebar" align:"center">';
		echo "<label><h2><em>&nbsp;Other Proposals</em></h2></label>";
		echo '<ul class = "sidebar">';	
		
		//echo "<div id=\"viewtype\">";
       // echo "<label><h2><em>&nbsp;Proposals</em></h2></label>";
       // echo "<ul id=\"category_menu\" class=\"MenuBarVertical\">";
			
		
		echo "<li><a href=\"#\" onclick=\"return false\" onmousedown=\"javascript:swapGeneralViewContent('all');\">All</a></li>";
		
		echo "<li><a href=\"#\" onclick=\"return false\" onmousedown=\"javascript:swapGeneralViewContent('approved');\">Approved</a></li>";
		
		echo "<li><a href=\"#\" onclick=\"return false\" onmousedown=\"javascript:swapGeneralViewContent('disapproved');\">Disapproved</a></li>";
		
		echo "<li><a href=\"#\" onclick=\"return false\" onmousedown=\"javascript:swapGeneralViewContent('under_review');\">Under Review</a></li>";
		

        echo " </ul>";
        echo "</div>";
        echo "<!--END OF viewtype ID-->";
		
		echo "<div id=\"view\">";
        echo "<blockquote><small>View proposals in the portal by clicking on the menu on the left.</small></blockquote>"; 
        echo "</div> <!--END OF view ID-->";	
		
		
		echo "<script type=\"text/javascript\">";
		echo "var MenuBar2 = new Spry.Widget.MenuBar(\"category_menu\", {imgRight:\"SpryAssets/SpryMenuBarRightHover.gif\"});";
    	echo "</script>";
		
		
		
	}
	
	
	
?>
