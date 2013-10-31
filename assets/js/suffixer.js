var checkTimer;

function handleEnter(event){
	
	console.log(event);
	
	if (event.which == 13){
		console.log(this);
	}
}


function checkSuffix(){
	
	$.post(
		base_URL+'js-scripts/check-suffix/',
		$('#suffixer-form').serialize(),
		function (data){
			resp = $.parseJSON(data);
			
			if (resp.info) {
				alert(resp.info);
			}
		}
	);
}