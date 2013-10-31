<div id="page" class="dictionary">
	<div class="container">
		
	<?php
				$i = 0;
				
				$inflection_list = array(
					array('type'=>'title','title'=>'Grammatical Cases'),
				
					array('type'=>'input','input'=>array('case'=>'nominative','other'=>'plural')),
					array('type'=>'sep'),
					
					array('type'=>'input','input'=>array('case'=>'accusative')),
					array('type'=>'hint','text'=>'Accusative case'),
					array('type'=>'sep'),
					
					array('type'=>'input','input'=>array('case'=>'genitive')),
					array('type'=>'input','input'=>array('case'=>'genitive','other'=>'plural')),
					array('type'=>'hint','text'=>'Genitive case [-n]'),
					array('type'=>'sep'),
					
					array('type'=>'input','input'=>array('case'=>'partitive')),
					array('type'=>'input','input'=>array('case'=>'partitive','other'=>'plural')),
					array('type'=>'hint','text'=>'Partitive case [-a/ä, -ta/tä, -tta/-ttä]'),
					
					array('type'=>'title','title'=>'Locative Cases'),
					
					array('type'=>'input','input'=>array('case'=>'illative')),
					array('type'=>'input','input'=>array('case'=>'illative','other'=>'plural')),
					array('type'=>'hint','text'=>'Illative case (into) [-Vn, -hVn]'),
					array('type'=>'sep'),
					
					array('type'=>'input','input'=>array('case'=>'inessive')),
					array('type'=>'input','input'=>array('case'=>'inessive','other'=>'plural')),
					array('type'=>'hint','text'=>'Inessive case (in, inside) [-ssa/ssä]'),
					array('type'=>'sep'),
					
					array('type'=>'input','input'=>array('case'=>'elative')),
					array('type'=>'input','input'=>array('case'=>'elative','other'=>'plural')),
					array('type'=>'hint','text'=>'Elative case (out of) [-sta/stä]'),
					array('type'=>'sep'),
					
					array('type'=>'input','input'=>array('case'=>'allative')),
					array('type'=>'input','input'=>array('case'=>'allative','other'=>'plural')),
					array('type'=>'hint','text'=>'Allative case (onto) [-lle]'),
					array('type'=>'sep'),
					
					array('type'=>'input','input'=>array('case'=>'adessive')),
					array('type'=>'input','input'=>array('case'=>'adessive','other'=>'plural')),
					array('type'=>'hint','text'=>'Adessive case (on) [-lla/llä]'),
					array('type'=>'sep'),
					
					array('type'=>'input','input'=>array('case'=>'ablative')),
					array('type'=>'input','input'=>array('case'=>'ablative','other'=>'plural')),
					array('type'=>'hint','text'=>'Ablative case (from) [-lta/ltä]'),
					array('type'=>'sep'),
					
					array('type'=>'title','title'=>'Marginal Cases'),
					
					array('type'=>'input','input'=>array('case'=>'essive')),
					array('type'=>'input','input'=>array('case'=>'essive','other'=>'plural')),
					array('type'=>'hint','text'=>'Essive case (as stg) [-na]'),
					array('type'=>'sep'),
					
					array('type'=>'input','input'=>array('case'=>'translative')),
					array('type'=>'input','input'=>array('case'=>'translative','other'=>'plural')),
					array('type'=>'hint','text'=>'TRanslative case (become) [-ksi]'),
					array('type'=>'sep'),
					
					array('type'=>'input','input'=>array('case'=>'abessive')),
					array('type'=>'input','input'=>array('case'=>'abessive','other'=>'plural')),
					array('type'=>'hint','text'=>'Abessive case (without) [-tta/ttä]'),
					array('type'=>'sep'),
					
					array('type'=>'input','input'=>array('case'=>'instructive','other'=>'plural')),
					array('type'=>'hint','text'=>'Instructive case () [-n]'),
					array('type'=>'sep'),
					
					array('type'=>'input','input'=>array('case'=>'comitative','other'=>'plural')),
					
				)
	?>
		
	<h1>Dictionary</h1>

	<div class="content">
		
		<?= form_open(uri_string()) ?>
		
			<fieldset>
				<legend><span class="entypo-pencil"></span>Search</legend>
				<input class="medium-input" type="text" name="word" value="<?= $word ?>" list="wordlist" placeholder="word" required autocomplete="off" />
				<input type="submit" value="search" />
				
				<datalist id="wordlist">
					<?php foreach($wordlist as $dicword){ ?>
						<option value="<?= $dicword->word ?>" />
					<?php } ?>
				</datalist>
			</fieldset>
			
		<?= form_close() ?>
		
		<?php if(isset($found) && !$found->list){ ?>
			
			<p class="info">The requested word was not found in the database</p>
		<?php } ?>
		
		<?php if(isset($found) && $found->list){ ?>
			<?php foreach($found->list as $item){ ?>
				
			<div class="dictionary-field">
				<fieldset>
					<legend><span class="entypo-book"></span>Dictionary</legend>
					<?php if(isset($item->ref)){ ?>
						<?php $orig = $item->ref ?>
						<h3><?= $item->word ?><span> is the
							<?php foreach($item->flags as $flag){ ?>
								
									<?php if($flag->definition){ ?>
										<a href="javascript:void(0)" title="<?= clean_string($flag->definition) ?>"><?= $flag->name ?></a>
									<?php }else{ ?>
										<?= $flag->name ?>
									<?php } ?> 
								
							<?php } ?>
							form of</span></h3>
							
					<?php }else $orig = $item; ?>
						<h1><?= $orig->word ?> <span><?= $orig->type ?></span></h1>
						<ol class="translation">
						<?php
							$translation = str_replace('[', '<i>', $orig->translation);
							$translation = str_replace(']', '</i>', $translation);
							$translation_array = explode(';',$translation);
							foreach ($translation_array as $translation_row){
						?>
							<li><?= $translation_row ?></li>
						<?php } ?>
						</ol>
						<div class="editor">
							<a class="button" href="<?= site_url('word-bulk-uploader/'.$orig->word) ?>"><span class="entypo-pencil"></span>Edit</a>
						</div>
				</fieldset>
			</div>
				
			<div class="inflections-field">
				<h2><span class="entypo-book-open"></span>Inflections</h2>
				
				<div class="row">
						
					<?php foreach($inflection_list as $listitem){ ?>
			
						<?php if($listitem['type'] == 'sep'){ ?>
							
						<?php }else if($listitem['type'] == 'title'){ ?>
							<div class="span12"><h3><?= $listitem['title'] ?></h3></div>
							
						<?php }else if($listitem['type'] == 'text'){ ?>
							<div class="span6"><?= $listitem['text'] ?> </span>
							
						<?php }else if($listitem['type'] == 'hint'){ ?>
							 
						<?php }else{ ?>
							
							<?php $i++; ?>
							<?php $index = ''; ?>
							<?php $index_name = ''; ?>
							<?php foreach ($listitem['input'] as $flagtype=>$flagname){ ?>
								<?php $index .= "_".$flagname; ?>
								<?php $index_name .= ($index_name)? " ".$flagname : $flagname ; ?>
							<?php } ?>
							<div class="span6">
								<i><?= $index_name ?></i>:
								<h4>
									<?= (isset($orig->inflections->{$index}))? $orig->inflections->{$index}->word:'-' ?><?php if(isset($orig->inflections->{$index}) && $index=='_comitative_plural'){ ?>-<span> (+possessive suffix)</span>
									<?php } ?>
								</h4>
							</div>
							
						<?php } ?>
						
						
					<?php } ?>
					
				
				</div>
			</div>
			<?php } ?>
		<?php } ?>
		
	</div>
	
	</div>
</div>