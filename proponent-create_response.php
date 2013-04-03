<?php 
	include "mysql_connect.php";
	
	session_start();
	$_SESSION['co_prop_err'] = 0;
	$_SESSION['file_err'] = 0;
	$_SESSION['fund_err'] = 0;
	$_SESSION['date_err'] = 0;
	$_SESSION['lack_err'] = 0;
	
	$co_prop1 = $_POST['co_prop1'];
	$co_prop2 = $_POST['co_prop2'];
	$co_prop3 = $_POST['co_prop3'];
	$title = $_POST['title'];
	$abstract = $_POST['abstract'];
	/*edited*/
	if($abstract == "Abstract Here"){
		$abstract = "";
	}
	$proposal = $_FILES['proposal']['name'];
	$proposal_type = $_FILES['proposal']['type'];
	$proposal_size = $_FILES['proposal']['size'];
	$fund = $_POST['fund'];
	$start_date = date_format(new DateTime($_POST['start_date']),'Y-m-d H:i:s'); 
	$end_date = date_format(new DateTime($_POST['end_date']),'Y-m-d H:i:s'); 	
	$today = date('Y-m-d H:i:s'); 
	$success = 1;
	$upload_error = "";	
	
	$user_id = $_COOKIE['user_id'];
	
	$sql = "SELECT * FROM proposal_file WHERE filename='$proposal'";
	$result =  mysql_query($sql);
	$count = mysql_num_rows($result);
	if ($count >= 1){
		$proposal = str_replace('.pdf', "_$user_id".".pdf", $proposal);	
	} 
	
	$target =  "proposals/".$proposal;	
	
	$under_review = 0;
	
	$_SESSION['title'] = $title;
	$_SESSION['abstract'] = $abstract;
	$_SESSION['fund'] = $fund;
	$_SESSION['start_date'] = $_POST['start_date'];
	$_SESSION['end_date'] = $_POST['end_date'];
	
	$_SESSION['title_set'] = !empty($title);
	$_SESSION['abstract_set'] = !empty($abstract);
	$_SESSION['fund_set'] = !empty($fund);
	/*edited*/
	$_SESSION['start_date_set'] = !empty($_POST['start_date']);
	$_SESSION['end_date_set'] = !empty($_POST['end_date']);
	/*end edited*/
	$_SESSION['proposal_set'] = !empty($proposal);	
	
	
	/*changed*/
	if(!empty($proposal)){
		if ($proposal_type != "application/pdf"){
		   //array_push($upload_error, "file type");	
		   $_SESSION['file_err'] = 1;	
		   $success = 0;   
	   }
	}
	
	if(!empty($fund)){
		if(!(is_numeric($fund))){
		 // array_push($upload_error, "fund amount");
		 	$_SESSION['fund_err'] = 1;
			$success = 0; 
	  }		
	}
	
	//edited
	if(!empty($_POST['start_date'])&& !empty($_POST['end_date'])){
	  if($end_date <= $start_date || $start_date <= $today){
		   //array_push($upload_error, "date conflict");
		   $_SESSION['date_err'] = 1;
		   $success = 0; 
	   }
	}
	/*end change*/
	
	if ( !empty($title) && !empty($abstract) &&
	   !empty($proposal) && !empty($fund) && !empty($_POST['start_date']) && !empty($_POST['end_date'])){
	
	  	if($success == 1){
	   
		  $sql = "INSERT INTO proposals (title, abstract, funding_request, start_date, end_date, status)
				  VALUES ('$title', '$abstract', '$fund', '$start_date', '$end_date', '$under_review')"; 		
		  $result = mysql_query($sql);
		  
		  $sql = "SELECT proposal_id 
				  FROM proposals 
				  WHERE title='$title' and abstract='$abstract' and funding_request='$fund'
				  and start_date='$start_date' and end_date='$end_date'";
		  $get_proposal_id = mysql_query($sql);
		  $count = mysql_num_rows($get_proposal_id);
			
		  if($count == 1){
			while($row = mysql_fetch_array($get_proposal_id)) {
					$proposal_id = $row['proposal_id'];
			}
			  $user_id = $_COOKIE['user_id'];	  	  
			  $sql = "INSERT INTO user_proposal(user_id, proposal_id, isMainProponent)
					  VALUES ('$user_id', '$proposal_id', 1)";
			  $result = mysql_query($sql);
			  
			  if($co_prop1 != 0){	 
				if(($co_prop1 != $co_prop2) && ($co_prop1 != $co_prop3)){
					  
					  $sql = "INSERT INTO user_proposal(user_id, proposal_id, isMainProponent)
							  VALUES ('$co_prop1', '$proposal_id', 0)";
					  $result = mysql_query($sql);
				}
				else{
				  //array_push($upload_error, "co-proponents");
				  $_SESSION['co_prop_err'] = 1;
				  $success = 0; 
				}
			  }
			 
			  
			  if($co_prop2 != 0){	
				  if(($co_prop1 != $co_prop2) && ($co_prop2 != $co_prop3)){ 
					  
					  $sql = "INSERT INTO user_proposal(user_id, proposal_id, isMainProponent)
							  VALUES ('$co_prop2', '$proposal_id', 0)";
					  $result = mysql_query($sql);
				  }
				  else{
					//array_push($upload_error, "co-proponents");
					 $_SESSION['co_prop_err'] = 1;
					 $success = 0; 
				  }
			  } 
			
			  
			  if($co_prop3 != 0){
				  if(($co_prop1 != $co_prop3) && ($co_prop2 != $co_prop3)){ 	
					  
					  $sql = "INSERT INTO user_proposal(user_id, proposal_id, isMainProponent)
							  VALUES ('$co_prop3', '$proposal_id', 0)";
					  $result = mysql_query($sql);
				  }
				   else{
					//array_push($upload_error, "co-proponents"); 
					 $_SESSION['co_prop_err'] = 1;
					 $success = 0; 
				  }
			 
			  }
			
			
		  }
		 
		  //upload file into db	
		  
		  if (move_uploaded_file($_FILES['proposal']['tmp_name'], $target)) {
			  
				   $sql = "SELECT proposal_id 
						   FROM proposals 
						   WHERE title='$title' and abstract='$abstract' and funding_request='$fund'
						   and start_date='$start_date' and end_date='$end_date'";
				  
				  $get_proposal_id = mysql_query($sql);
				  $count = mysql_num_rows($get_proposal_id);
					
				  if($count == 1){
					while($row = mysql_fetch_array($get_proposal_id)) {
						$proposal_id = $row['proposal_id'];
					}
					
					$sql = "INSERT INTO proposal_file (filename, proposal_id, size, type)
						  VALUES ('$proposal', '$proposal_id', '$proposal_size', '$proposal_type')"; 		
					
					 $result = mysql_query($sql);
					 
					}
				
		  }
		   else{
			  //array_push($upload_error, "file upload");
			  $_SESSION['file_err'] = 1;
			  $success = 0; 
		   }
	  }//endbigif
	 
	}
	else{
		// array_push($upload_error, "lacking info");
		 $_SESSION['lack_err'] = 1;
		 $success = 0; 
	}
	
	if($success == 1){
		header("Location: proponent-create_success.php#container");
    }
	else{
		header("Location: proponent-create_fail.php#container");	
	}
?>
