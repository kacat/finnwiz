var checkTimer;

function handleEnter(event){
	
	console.log(event);
	
	if (event.which == 13){
		console.log(this);
	}
}


function checkVerb(){
	
	$.post(
		base_URL+'scripts/check-verb/',
		{'inf':$('#inf').val()},
		function (data){
			//console.log(data);
			resp = $.parseJSON(data);
			
			if (resp.type == 'list') {
				$('#inf-list').html(resp.html);
				$('#inf-data').html('multiple results');
				$('#inf-id').val('');
				resetVerb();
			}
			else if (resp.type == 'single') {
				$('#inf-list').html('');
				$('#inf-id').val(resp.id);
				$('#inf-data').html(resp.inf + ' [ id : '+resp.id+' ]');
				loadVerb(resp.id);
			}else{
				$('#inf-list').html('');
				$('#inf-data').html('no results');
				$('#inf-id').val('');
				resetVerb();
			}
		}
	);
}

function loadVerb(id){
	if (!id) {
		resetVerb();
		return;
	}
	
	$.post(
		base_URL+'scripts/load-verb/',
		{'id':id, 'mood':$('#mood').val(), 'tense':$('#tense').val(), 'form':$('#form').val()},
		function (data){
			//console.log(data);
			resp = $.parseJSON(data);
			
			$('#type').val(resp.type);
			$('#eng').val(resp.eng);
			
			$('#s1').val(resp.s1);
			$('#s2').val(resp.s2);
			$('#s3').val(resp.s3);
			
			$('#p1').val(resp.p1);
			$('#p2').val(resp.p2);
			$('#p3').val(resp.p3);
			
			$('#passive').val(resp.passive);
		}
	);
}

function resetVerb(){
	$('#type').val(1);
	$('#eng').val('');
			
	$('#s1').val('');
	$('#s2').val('');
	$('#s3').val('');
			
	$('#p1').val('');
	$('#p2').val('');
	$('#p3').val('');
			
	$('#passive').val('');
}

function saveVerb(){
	if(!$('#inf').val()) return;
	
	var verbData = $('#verb-upload-form').serialize();
	
	$.post(
		base_URL+'scripts/save-verb/',
		verbData,
		function(data){
			//console.log(data);
			resp = $.parseJSON(data);
			$('#inf-id').val(resp.id);
			loadVerb(resp.id);
			if (resp.script == 'success') alert('verb added successfully');
		}
	);
}
