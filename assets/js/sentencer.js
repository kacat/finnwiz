var checkTimer;

function handleEnter(event){
	
	console.log(event);
	
	if (event.which == 13){
		console.log(this);
	}
}


function checkSentence(){
	
	$.post(
		base_URL+'js-scripts/check-sentence/',
		$('#sentencer-form').serialize(),
		function (data){
			//console.log(data);
			resp = $.parseJSON(data);
			
			if (resp.info) {
				alert(resp.info);
			}
		}
	);
}