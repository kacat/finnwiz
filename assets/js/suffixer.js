var checkTimer;

function handleEnter(event){
	
	console.log(event);
	
	if (event.which == 13){
		console.log(this);
	}
}


function checkSuffix(){
	$('.controls .submit').addClass('hidden');
	
	$.post(
		base_URL+'js-scripts/check-suffix/',
		$('#suffixer-form').serialize(),
		function (data){
			resp = $.parseJSON(data);
			console.log(resp);
			
			if (resp.info) {
				if(resp.info.result){
					$('#solution').addClass('correct');
				}else{
					$('#solution').addClass('wrong');
					$('.correct-solution-container').html('<span></span> The correct answer is: <b>'+resp.info.bestmatch+'</b>');
					$('.correct-solution').slideDown('fast');
				}
			}
			
			$('.controls .next').removeClass('hidden');
			$('.controls .next a').focus();
		}
	);
}