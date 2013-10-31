$(document).ready(function(){
	//prepares the hint buttons by adding the mouseover and moving the data from the 'title' attribute to the elements dataset;
	$('a.hint, a.button-hint').each(function(){
		if ($(this).attr('title')){
			$(this).data('hint', $(this).attr('title'));
			$(this).bind('mouseover', function(){ showHint($(this).data('hint'), $(this)); });
			$(this).bind('mouseout', function(){ startHintCounter(); });
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
	var position = getPosition(target);

	var html = '<div id="hintbox" onmouseover="resetHintCounter();" onmouseout="startHintCounter();" class="hidden"><div class="hintbox-wrapper">';
	html += '<div class="hintbox-text">'+text+'</div>';
	html += '<div class="hintbox-arrow"></div>';
	html += '</div></div>';
	
	$('body').append(html);
	
	
	position.top -= $('#hintbox').height()+20;
	position.left -= $('#hintbox').width()- 25 - target.width();
    
    $('#hintbox').css({top: position.top, left: position.left});
    
    $('#hintbox').fadeIn('fast');
}

function startHintCounter(){
	clearTimeout(hintCounter);
	hintCounter = setTimeout('hideHint()',1000);
}

function resetHintCounter(){
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