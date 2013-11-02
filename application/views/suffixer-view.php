<div id="page" class="suffixer">
	<div class="container">
	<h1>Suffixer</h1>

	<div class="content">
		
		<form id="suffixer-form" name="suffixer-form" action="javascript:checkSuffix();" method="POST">
			<fieldset>
				<legend><span class="entypo-help"></span>Word</legend>
				<div>
					<h2>
						<?php if($word->item->translation){ ?>
							<?= $word->item->translation ?>
							<span class="cases">(
							<?php foreach($word->item->flags as $flag){ ?>
								<?php if($flag->definition){ ?>
									<a class="hint" title="<?= $flag->definition ?>"><?= $flag->name ?></a>
								<?php }else{ ?>
									<?= $flag->name ?>
								<?php } ?>
							<?php } ?>
							)</span>
							
						<?php }else{ ?>
							<span class="cases">
							<?php foreach($word->item->flags as $flag){ ?>
								<?php if($flag->definition){ ?>
									<a class="hint" title="<?= $flag->definition ?>"><?= $flag->name ?></a>
								<?php }else{ ?>
									<?= $flag->name ?>
								<?php } ?>
							<?php } ?>
							</span>
							<span class="text">of the word</span> <?= $word->item->orig ?></h2>
						<?php } ?>
				</div>
			</fieldset>
			
			<fieldset>
				<legend><span class="entypo-pencil"></span>Solution</legend>
				
				<input class="full-length" id="solution" type="text" name="suffixer_translation" value=""/>
				<div class="correct-solution hidden">
					<div class="correct-solution-container">
						<span></span>correct solution
					</div>
				</div>
				<div class="controls">
					<div class="submit">
						<a class="button" href="#" onclick="$('#suffixer-form').submit(); return false">Check</a>
					</div>
					<div class="next hidden">
						<a class="button next" href="">Next <span></span></a>
					</div>
				</div>
				<input type="hidden" name="id" value="<?= $word->id ?>" />
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