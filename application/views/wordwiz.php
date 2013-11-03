<div id="page">
	<div class="container">
		<h1>WordWizard</h1>
	
		<div class="content">
			
			<?= form_open(uri_string()) ?>
			
				<p>
					<input class="medium-input" type="text" name="word" value="<?= $word ?>" placeholder="word" required />
					<input class="button" type="submit" value="create" />
				</p>
				
			<?= form_close() ?>
			
			<?php if(isset($wordwiz) && !$wordwiz->item){ ?>
				<hr />
				<p>Something did't quite work out</p>
			<?php } ?>
			
			<?php if(isset($wordwiz) && $wordwiz->item){ ?>
				<p>
					<ol>
						<li>
							genitive: <b><?= $wordwiz->item->genitive ?></b>
						</li>
						<li>
							genitive plural: <b><?= $wordwiz->item->genitive_plural ?></b>
						</li>
						<hr />
						<li>
							partitive: <b><?= $wordwiz->item->partitive ?></b>
						</li>
						<?php /*
						<li>
							partitive plural: <b><?= $wordwiz->item->partitive_plural ?></b>
						</li>
						 * 
						 */ ?>
					</ol>
				</p>
			<?php } ?>
			
		</div>
	</div>
</div>