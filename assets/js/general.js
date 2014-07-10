$(document).ready(function(){
	//prepares the hint buttons by adding the mouseover and moving the data from the 'title' attribute to the elements dataset;
	$('a.hint, a.button-hint').each(function(){
		if ($(this).attr('title')){
			$(this).data('hint', $(this).attr('title'));
			$(this).bind('mouseover', function(){ showHint($(this).data('hint'), $(this)); });
			$(this).bind('mouseout', function(){ hideHint(); });
			$(this).removeAttr('title');
		}
	});
});

$(document).ajaxStart(function(){
	$('#ajax-load-indicator').fadeIn();
});

$(document).ajaxStop(function(){
	$('#ajax-load-indicator').fadeOut();
});

//hints

var hintCounter;

function showHint(text, target){
	$('#hintbox').remove();
	clearTimeout(hintCounter);
	//var position = getPosition(target);

	var html = '<div id="hintbox" class="hidden"><div class="hintbox-wrapper">';
	html += '<div class="hintbox-text">'+text+'</div>';
	html += '<div class="hintbox-arrow"></div>';
	html += '</div></div>';
	
	$('body').append(html);
	
	
	//position.top -= $('#hintbox').height()+15;
	//position.left -= -5; //$('#hintbox').width()- 25 - target.width();
    
    //$('#hintbox').css({top: position.top, left: position.left});
    
    $('#hintbox').fadeIn('fast');
    
    $(document).mousemove(function(event) {
    	$('#hintbox').css({top: event.pageY+10, left: event.pageX+10});
    });
}

function startHintCounter(){
	clearTimeout(hintCounter);
	hintCounter = setTimeout('hideHint()',500);
}

function resetHintCounter(){
	//$('#hintbox').stop(true,true).fadeIn('fast');
	clearTimeout(hintCounter);
}

function hideHint(){
	$('#hintbox').fadeOut('fast');
}

function getPosition (trg, ignoreTopScroll) {
	
	var output = new Object();
	var offset = trg.offset();
	
	output.left = offset.left;
	output.top = offset.top;
	return output;
}

function reload_page(){
	window.location.reload();
}

function goto_page(url){
	window.location = url;
}

function processResp(data){
	var respdata = new Object();
	try{ respdata = $.parseJSON(data); }
	catch(err){
		alert(data);
	}
	
	if (respdata.error){
		alert(respdata.error);
		respdata = new Object();
	}
	
	return respdata;
}
