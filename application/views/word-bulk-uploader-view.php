<div id="page">
	<div class="container">
	
	<h1>Word bulk uploader</h1>

	<div class="content">
		
		<?= form_open(uri_string()) ?>
		
			<?php if(isset($word_added)){ ?>
				<p class="success"><span></span>The word was successfully added to the database</p>
			<?php } ?>
			
			<?php if(isset($word_updated)){ ?>
				<p class="success"><span></span>The word was successfully updated</p>
			<?php } ?>
			
			<?php
				$i = 0;
				$infl = (isset($word->item->inflections))? $word->item->inflections:FALSE;
				
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
					array('type'=>'text','text'=>'- (+possessive suffix)'),
					
				)
			?>
			
			<fieldset>
				<legend><span class="entypo-book"></span>Word</legend>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="<?= ($word)? $word->item->word:'' ?>" placeholder="word" required />
				<?php if($word){ ?>
					<a class="button" href="<?= site_url('word-bulk-uploader') ?>">reset</a>
				<?php } ?>
				<br />
				<textarea class="medium-input" name="word[<?= $i ?>][data][translation]"  placeholder="in english" required><?= ($word)? $word->item->translation:'' ?></textarea>
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="nominative" />
				<input type="hidden" name="word[<?= $i ?>][data][id]" value="<?= ($word)? $word->id:0 ?>" />
			
			
				<div class="select">		
					<select name="word[<?= $i ?>][data][type]" id="type">
						<option value="noun" <?= ($word && $word->item->type == 'noun')? 'selected="selected"':'' ?> >noun</option>
						<?php /*<option value="verb" <?= ($word && $word->type == 'verb')? 'selected="selected"':'' ?> >verb</option> */ ?>
						<option value="adjective" <?= ($word && $word->item->type == 'adjective')? 'selected="selected"':'' ?>>adjective</option>
						<?php /*<option value="pronoun" <?= ($word && $word->type == 'pronoun')? 'selected="selected"':'' ?> >pronoun</option> */ ?>
						<?php /*<option value="numeral" <?= ($word && $word->type == 'numeral')? 'selected="selected"':'' ?> >numeral</option> */ ?>
					</select>
					<span></span>
				</div>
			
			<?php foreach($inflection_list as $listitem){ ?>
			
				<?php if($listitem['type'] == 'sep'){ ?>
					<hr />
					
				<?php }else if($listitem['type'] == 'title'){ ?>
					</fieldset>
					<fieldset>
						<legend><span class="entypo-book-open"></span><?= $listitem['title'] ?></legend>
					
				<?php }else if($listitem['type'] == 'text'){ ?>
					<?= $listitem['text'] ?> 
					
				<?php }else if($listitem['type'] == 'hint'){ ?>
					<a class="button-hint" title="<?= $listitem['text'] ?>"></a> 
				<?php }else{ ?>
					
					<?php $i++; ?>
					<?php $index = ''; ?>
					<?php $index_name = ''; ?>
					<?php foreach ($listitem['input'] as $flagtype=>$flagname){ ?>
						<input type="hidden" name="word[<?= $i ?>][flags][<?= $flagtype ?>]" value="<?= $flagname ?>" />
						<?php $index .= "_".$flagname; ?>
						<?php $index_name .= ($index_name)? " ".$flagname : $flagname ; ?>
					<?php } ?>
					<input type="hidden" name="word[<?= $i ?>][data][id]" value="<?= (isset($infl->{$index}->id))? $infl->{$index}->id:0 ?>" />
					<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="<?= (isset($infl->{$index}->word))? $infl->{$index}->word:'' ?>" placeholder="<?= $index_name ?>" />
					
				<?php } ?>
				
				
			<?php } ?>
			
			</fieldset>
			
			<input type="hidden" name="id" value="<?= ($word)? $word->id:0 ?>"
			
			<fieldset>
				<div>
					<input type="submit" value="<?= ($word)? 'update':'create'?>" />
				</div>
			</fieldset>
		
		<?= form_close() ?>
	</div>
	
	</div>
</div>

<script type="text/javascript">
	setTimeout(function(){
		$('.success').slideUp('fast');
	}, 3000);
</script>