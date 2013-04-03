// JavaScript Document
	function swapIndexContent(content) {
		var url = "index-contentchange.php"
			$.post(url, {contentVar: content}, 
				function(data) {
					$("#container").html(data).show(); 
				}
			);	
	}

	function swapContent(content) {
		var url = "proponent-contentchange.php"
			$.post(url, {contentVar: content}, 
				function(data) {
					$("#container").html(data).show(); 
				}
			);	
	}
	
	function swapMyViewContent(content){
		var url = "proponent-myview-specific.php"
			$.post(url, {contentVar: content}, 
				function(data) {
					$("#view").html(data).show(); 
				}
			);	
	}
	
	/*function swapGeneralViewContent(content){
		var url = "proponent-general_view-specific.php"
			$.post(url, {contentVar: content}, 
				function(data) {
					$("#view").html(data).show(); 
				}
			);	
	}*/
	
	function swapGeneralProposalContent(prop_id, viewtype, back_to){
		var url = "proponent-proposal-specific.php"
			$.post(url, {propIDVar: prop_id, viewtypeVar: viewtype, backtoVar: back_to}, 
				function(data) {
					$("#container").html(data).show(); 
				}
			);	
	}
	
	function clearContents(element) {
	  element.value = '';
	}
	
	function swapProposalContent(prop_id, viewtype, back_to){
		var url = "proponent-proposal-specific.php"
			$.post(url, {propIDVar: prop_id, viewtypeVar: viewtype, backtoVar: back_to}, 
				function(data) {
					$("#view").html(data).show(); 
				}
			);	
	}
	
