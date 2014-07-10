<div id="page" class="dictionary">
	<div class="container">
		
		<h1>biBook v1.0</h1>
		
		<div class="content reader">
			
			<fieldset>
				<legend><span class="entypo-book"></span>Reader</legend>
				<div class="lang_fi page">
					<div class="content">
						<?= $book->book_fi->content ?>
					</div>
				</div>
		
				<div class="lang_en page">
					<div class="content floater">
						<?= $book->book_en->content ?>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.lang_fi span').mouseover(function(evt){
		$('.lang_fi span').removeClass('selected');
		$('.lang_en span').removeClass('selected');
		
		$(this).addClass('selected');
		var myIndex = $('.lang_fi span').index(this);
		var trg = $('.lang_en span:eq('+myIndex+')');
		var mypos = $(this).position();
		
		//console.log(trg);
		
		if(trg.length){
			var itpos = trg.position();
		
			//console.log(mypos.top, itpos.top);
		
			var diff = mypos.top - itpos.top;
		
			if ($('.lang_en .floater').css('top') != diff + 'px'){
				$('.lang_en .floater').stop(true,true).animate({top: diff + 'px'}, 'fast');
			}
		
			trg.addClass('selected');
		}
		
	});
	
	$('.lang_en').height($('.lang_fi').height()); 
	
	$('.lang_en span').mouseover(function(evt){
		$('.lang_fi span').removeClass('selected');
		$('.lang_en span').removeClass('selected');
		
		$(this).addClass('selected');
		var myIndex = $('.lang_en span').index(this);
		var trg = $('.lang_fi span:eq('+myIndex+')');
		var mypos = $(this).position();
		
		if(trg.length){
			var itpos = trg.position();
		
			//console.log(mypos.top, itpos.top);
		
			var diff = itpos.top - mypos.top;
		
			if ($('.lang_en .floater').css('top') != diff + 'px'){
				$('.lang_en .floater').stop(true,true).animate({top: diff + 'px'}, 'fast');
			}
		
			trg.addClass('selected');
		}
		
	})
</script>