<div id="page">
	<h1>Sentencer</h1>

	<div class="content">
		
		<form id="sentencer-form" name="sentencer-form" action="javascript:checkSentence();" method="POST">
			<fieldset>
				<legend>Sentence to translate</legend>
				<div>
					<?= $sentence->english ?>
				</div>
			</fieldset>
			
			<fieldset>
				<legend>Finnish translation</legend>
				<input class="full-length" type="text" name="sentencer_translation" value=""/>
				<input type="submit" value="Submit" />
				<input type="hidden" name="id" value="<?= $sentence->id ?>" />
			</fieldset>
		</form>
	</div>
</div>