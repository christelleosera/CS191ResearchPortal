<style type="text/css">
#reviewproposal {
   margin-left: 1em;
   float: left;
   border-right: 1px solid #D0D0D0;
   padding: 10px;
}

#proposal_details {
   margin-left: 1em;
   float: left;
   padding: 10px;
}

#proposal_details table {
   border-collapse: collapse;
   width: 100%;
   max-width: 30em;
}

#proposal_details td, #proposal_details th {
   border: 1px solid #D0D0D0;
   padding: 0.2em 1em 0.2em 0.7em;
   text-align: left;
   vertical-align: top;
   max-width: 23em;
}
</style>

<?php
   include "mysql_connect.php";

   $proposal_id = $_POST['propIDVar'];
   setcookie('proposal_id', $proposal_id);
   
   $sql = "SELECT title, abstract, funding_request, start_date, end_date
			    FROM proposals 
				WHERE proposal_id = '$proposal_id'";
		
	$result = mysql_query($sql);
		
	//get number of result data
	$num_results = mysql_num_rows($result); 
		
	if ($num_results = 1){
			$proposal = mysql_fetch_array($result);
			
			$title = $proposal ['title'];
			$abstract = $proposal ['abstract'];
			$funding = $proposal['funding_request'];
			$start_date = $proposal ['start_date'];
			$end_date = $proposal['end_date'];
			
			echo '<div id="reviewproposal">	
        <h2>
			<input type=image src="img/back.png" onclick="return false" onmousedown="javascript:swapContent(\'pending\');"/>
			&nbsp;Review Proposal
		  </h2>
        <form enctype="multipart/form-data" name="review_form" action="submitreview.php" method="POST">
           <table cellpadding=0>
            <tr>
             <td><input type=radio name="decision" value="approve">Approve</td>
             <td><input type=radio name="decision" value="disapprove">Disapprove</td>
             <td><input type=radio name="decision" value="abstain">Abstain</td>
            </tr>
            <tr>
             <td colspan=3>
              <h4>Explain your decision:</h4>
              <textarea style="resize:none;" name="review" rows=20 cols=65 title="Explain your decision"></textarea>
             </td>
            </tr>
            <tr>
             <td colspan=3>
              <h4>Or upload your review as a PDF file:</h4>
              <input type="file" name="review_pdf"/>
             </td>
            </tr>
            <tr>
             <td colspan=3>
             <br>
              <input type="submit" name="submit" value="Submit"/>
             </td>
            </tr>
           </table>
        </form>
   	</div> <!--END OF reviewproposal ID-->
	   <div id="proposal_details">
           <h2 id="title">Proposal Details</h2>
           <table cellpadding=3>
	         <tr>
             <th>Title</th>
             <td>'.$title.'</td>
            </tr>
	         <tr>
             <th>Funding Request</th>
             <td>'.$funding.'</td>
            </tr>
	         <tr>
             <th>Starting Date</th>
             <td>'.$start_date.'</td>
            </tr>
	         <tr>
             <th>Ending Date</th>
             <td>'.$end_date.'</td>
            </tr>
	         <tr>
             <th>Abstract</th>
             <td>'.$abstract.'</td>
            </tr>
           </table>
	   </div> <!--END OF proposal_details ID-->';

	}
	else{
		echo "Can't retrieve your proposal";
	}



?>
