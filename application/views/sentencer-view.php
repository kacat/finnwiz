<div id="page" class="sentencer">
	<div class="container">
	<h1>Sentencer</h1>

	<div class="content">
		
		<form id="sentencer-form" name="sentencer-form" action="javascript:checkSentence();" method="POST">
			<fieldset>
				<legend><span class="entypo-help"></span>Sentence to translate</legend>
				<div>
					<?= $sentence->english ?>
				</div>
			</fieldset>
			
			<fieldset>
				<legend><span class="entypo-pencil"></span>Finnish translation</legend>
				<input class="full-length" type="text" id="solution" name="sentencer_translation" value=""/>
				
				<div class="correct-solution hidden">
					<div class="correct-solution-container">
						<span></span>correct solution
					</div>
				</div>
				<div class="controls">
					<div class="submit">
						<a class="button" href="#" onclick="$('#sentencer-form').submit(); return false">Check</a>
					</div>
					<div class="next hidden">
						<a class="button next" href="">Next <span></span></a>
					</div>
				</div>
				
				
				<input type="hidden" name="id" value="<?= $sentence->id ?>" />
			</fieldset>
		</form>
	</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#solution').focus();
	})
</script>