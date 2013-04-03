<?php
	include 'mysql_connect.php';
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	//user typed in his username and password
	if($username && $password) {
		//identify user from persons table
		$sql = "SELECT * FROM users WHERE username='$username' and password='$password'";
	
		//send query
		$result = mysql_query($sql);
	
		//get the number rows in table result
		$count = mysql_num_rows($result);
	
		while($row = mysql_fetch_array($result)) {
			$user_id = $row['user_id'];
			$role = $row['role'];
		}
	
	
		//only one match for it to be correct
		if($count == 1) {
			setcookie ('username', $username);
			setcookie ('user_id', $user_id);
						
			//user is an admin
			if($role == "Admin" ) {
				header("Location: index-admin.php");
			}
	
			//user is a proponent
			if($role == "Proponent" ) {
				header("Location: index-proponent.php");
			}
			
			//user is a reviewer
			if($role == "Reviewer") {
				//setcookie ('branchid', $branchid);
				header("Location: index-reviewer.php");
			}
		}
		else {
			header("Location: login-fail.php");
		}
	}
	
	//no user input
	else {
		header("Location: login.php");
	}
?>