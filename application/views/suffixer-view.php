<div id="page" class="suffixer">
	<div class="container">
	<h1>Suffixer</h1>

	<div class="content">
		
		<form id="suffixer-form" name="suffixer-form" action="javascript:checkSuffix();" method="POST">
			<fieldset>
				<legend><span class="entypo-help"></span>Word</legend>
				<div>
					<h2><span><b><?= $case ?></b></span> of the word <?= $orig ?></h2>
				</div>
			</fieldset>
			
			<fieldset>
				<legend><span class="entypo-pencil"></span>Solution</legend>
				<input class="full-length" type="text" name="suffixer_translation" value=""/>
				<input type="submit" value="Submit" />
				<input type="hidden" name="id" value="<?= $id ?>" />
			</fieldset>
		</form>
	</div>
	</div>
</div>