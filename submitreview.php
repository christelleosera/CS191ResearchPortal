<?php
	include 'mysql_connect.php';
	
	$user_id = $_COOKIE['user_id'];
	$proposal_id = $_COOKIE['proposal_id'];
	// @ suppresses the error if no radio button was selected
	$radio_decision = @$_POST['decision'];
	$review_text = $_POST['review'];
	$review_pdf = @$_FILES['review_pdf']['name'];
	
	if ($radio_decision == 'approve')
		$decision = 1;
	else if ($radio_decision == 'disapprove')
		$decision = 0;
	else if ($radio_decision == 'abstain')
		$decision = 2;
	
	if (empty($radio_decision)) {
		echo 'No decision was selected!<br>';
	}
	if (empty($review_text) && empty($review_pdf)) {
		echo 'You didn\'t enter any details!<br>';
	}
	if(!empty($radio_decision) && (!empty($review_text) || !empty($review_pdf))) {
/*		$sql = "UPDATE evaluation SET decision='".$decision."', review='".$review.
		"' WHERE user_id='".$user_id."' AND proposal_id='".$proposal_id."'";*/
		if (!empty($review_pdf))
			$review = $review_pdf;
		else
			$review = $review_text;
		$sql = "INSERT INTO evaluation (user_id, proposal_id, decision, review) VALUES
				('$user_id', '$proposal_id', '$decision', '$review')";
		
		//send query
		$result = mysql_query($sql);
		
		header('Location: review-success.php');
	}
	else {
		echo '<br>Go back and try again.';
	}
?>
