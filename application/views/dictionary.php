<div id="page">
	<h1>Dictionary</h1>

	<div class="content">
		
		<?= form_open(uri_string()) ?>
		
			<p>
				<input class="medium-input" type="text" name="word" value="<?= $word ?>" placeholder="word" required />
				<input type="submit" value="search" />
			</p>
			
		<?= form_close() ?>
		
		<?php if(isset($found) && !$found->list){ ?>
			<hr />
			<p>The requested word was not found in the database</p>
		<?php } ?>
		
		<?php if(isset($found) && $found->list){ ?>
			<?php foreach($found->list as $item){ ?>
				
				<hr />
				<p>
					<?php if(isset($item->ref)){ ?>
						<?php $orig = $item->ref ?>
						<h3><?= $item->word ?></h3> is the
							<?php foreach($item->flags as $flag){ ?>
								<span>
									<?php if($flag->definition){ ?>
										<a href="javascript:void(0)" title="<?= clean_string($flag->definition) ?>"><?= $flag->name ?></a>
									<?php }else{ ?>
										<?= $flag->name ?>
									<?php } ?> 
								</span>
							<?php } ?>
							form of
							
					<?php }else $orig = $item; ?>
						<h2><?= $orig->word ?></h2>
						<ol>
						<?php
							$translation = str_replace('[', '<i>', $orig->translation);
							$translation = str_replace(']', '</i>', $translation);
							$translation_array = explode(';',$translation);
							foreach ($translation_array as $translation_row){
						?>
							<li><?= $translation_row ?></li>
						<?php } ?>
						</ol>
				</p>
				
				<h2>Inflections</h2>
				<div class="row clearfix">
					<?php foreach($orig->inflections as $inflection){ ?>
						<div class="span3 clearfix">
							<div class="left">
								<?php foreach($inflection->flags as $flag){ ?>
								<i>
									<?php if($flag->definition){ ?>
										<a class="hint" href="#" title="<?= clean_string($flag->definition) ?>"><?= $flag->name ?></a>
									<?php }else{ ?>
										<?= $flag->name ?>
									<?php } ?> 
								</i>
								<?php } ?>:
							</div>
							<div class="right"><b><?= $inflection->word ?></b></div>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		<?php } ?>
		
	</div>
</div>