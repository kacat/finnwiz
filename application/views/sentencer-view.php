<div id="page">
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
				<input class="full-length" type="text" name="sentencer_translation" value=""/>
				<input type="submit" value="Submit" />
				<input type="hidden" name="id" value="<?= $sentence->id ?>" />
			</fieldset>
		</form>
	</div>
	</div>
</div>