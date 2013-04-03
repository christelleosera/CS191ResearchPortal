// JavaScript Document
	
	function swapContent(content) {
		var url = "reviewer-contentchange.php"
			$.post(url, {contentVar: content}, 
				function(data) {
					$("#container").html(data).show(); 
				}
			);	
	}
	
	function swapReviewedContent(content) {
		var url = "reviewer-myview-specific.php"
			$.post(url, {contentVar: content}, 
				function(data) {
					$("#view").html(data).show(); 
				}
			);	
	}
	
	
	function swapGeneralViewContent(content) {
		var url = "reviewer-others.php"
			$.post(url, {contentVar: content}, 
				function(data) {
					$("#view").html(data).show(); 
				}
			);	
	}
	
	
	
	
	function swapProposalContent(prop_id, view_type, back_to){
		var url = "reviewer-proposal-specific.php"
			$.post(url, {propIDVar: prop_id, viewtypeVar: view_type, backtoVar: back_to}, 
				function(data) {
					$("#view").html(data).show(); 
				}
			);	
	}
	
	function swapReviewProposalContent(prop_id){
		var url = "review_proposal.php"
			$.post(url, {propIDVar: prop_id}, 
				function(data) {
					$("#container").html(data).show(); 
				}
			);	
	}
	
	
