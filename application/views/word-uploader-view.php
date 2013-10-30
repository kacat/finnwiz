<div id="page">
	<h1>Word uploader</h1>

	<div class="content">
		
		<?= form_open(uri_string()) ?>
			<p>
				<input class="medium-input" list="word-list" type="text" id="word" name="data[word]" value="<?= ($word)? $word->word:'' ?>" placeholder="word" required onkeyup="checkWord();"/>
				<input class="medium-input" type="text" id="eng" name="data[translation]" value="<?= ($word)? $word->translation:'' ?>" placeholder="in english" />
				<span id="word-data"></span>
				<input type="hidden" name="id" id="word-id" value="<?= ($word)? $word->id:'' ?>" />
			</p>
			<p>
				<?php if($word && $word->ref){ ?>
					inflection of <b><?= $word->ref->word ?></b> <i><?= $word->ref->type ?></i>
				<?php }else{ ?>
				type: <select name="type" id="type">
					<option value="noun" <?= ($word && $word->type == 'noun')? 'selected="selected"':'' ?> >noun</option>
					<option value="verb" <?= ($word && $word->type == 'verb')? 'selected="selected"':'' ?> >verb</option>
					<option value="adjective" <?= ($word && $word->type == 'adjective')? 'selected="selected"':'' ?> >adjective</option>
					<option value="pronoun" <?= ($word && $word->type == 'pronoun')? 'selected="selected"':'' ?> >pronoun</option>
					<option value="numeral" <?= ($word && $word->type == 'numeral')? 'selected="selected"':'' ?> >numeral</option>
					<option value="" >inflection of</option>
				</select>
				<?php } ?>
				
				<datalist id="inf-list">
				</datalist>
			</p>
			
			<p>
				<input type="checkbox" id="word-plural" name="flags[other]" value="plural" <?= (isset($word->flags->plural))? 'checked="checked"':'' ?> />
				<label for="word-plural">plural</label>
				<hr />
				<h3>Cases</h3>
				
				<input type="radio" id="word-nominative" name="flags[case]" value="nominative" <?= (isset($word->flags->nominative) || !$word)? 'checked="checked"':'' ?> />
				<label for="word-nominative">nominative</label>
				<input type="radio" id="word-genitive" name="flags[case]" value="genitive" <?= (isset($word->flags->genitive))? 'checked="checked"':'' ?> />
				<label for="word-genitive">genitive</label>
				<input type="radio" id="word-partitive" name="flags[case]" value="partitive" <?= (isset($word->flags->partitive))? 'checked="checked"':'' ?> />
				<label for="word-partitive">partitive</label>
				<input type="radio" id="word-accusative" name="flags[case]" value="accusative" <?= (isset($word->flags->accusative))? 'checked="checked"':'' ?> />
				<label for="word-accusative">accusative</label>
				
				
				<br />
				<input type="radio" id="word-illative" name="flags[case]" value="illative" <?= (isset($word->flags->illative))? 'checked="checked"':'' ?> />
				<label for="word-illative">illative</label>
				<input type="radio" id="word-inessive" name="flags[case]" value="inessive" <?= (isset($word->flags->inessive))? 'checked="checked"':'' ?> />
				<label for="word-inessive">inessive</label>
				<input type="radio" id="word-elative" name="flags[case]" value="elative" <?= (isset($word->flags->elative))? 'checked="checked"':'' ?> />
				<label for="word-elative">elative</label>
				
				<br />
				<input type="radio" id="word-allative" name="flags[case]" value="allative" <?= (isset($word->flags->allative))? 'checked="checked"':'' ?> />
				<label for="word-allative">allative</label>
				<input type="radio" id="word-adessive" name="flags[case]" value="adessive" <?= (isset($word->flags->adessive))? 'checked="checked"':'' ?> />
				<label for="word-adessive">adessive</label>
				<input type="radio" id="word-ablative" name="flags[case]" value="ablative" <?= (isset($word->flags->ablative))? 'checked="checked"':'' ?> />
				<label for="word-ablative">ablative</label>
				
				<br />
				<input type="radio" id="word-essive" name="flags[case]" value="essive" <?= (isset($word->flags->essive))? 'checked="checked"':'' ?> />
				<label for="word-essive">essive</label>
				<input type="radio" id="word-translative" name="flags[case]" value="translative" <?= (isset($word->flags->translative))? 'checked="checked"':'' ?> />
				<label for="word-adessive">translative</label>
				<input type="radio" id="word-comitative" name="flags[case]" value="comitative" <?= (isset($word->flags->comitative))? 'checked="checked"':'' ?> />
				<label for="word-ablative">comitative</label>
				<input type="radio" id="word-instructive" name="flags[case]" value="instructive" <?= (isset($word->flags->instructive))? 'checked="checked"':'' ?> />
				<label for="word-instructive">instructive</label>
				
				<hr />
				
				<h3>Posession</h3>
				<input type="radio" id="word-posessive1" name="flags[posession]" value="posessive 1st person" <?= (isset($word->flags->posessive1))? 'checked="checked"':'' ?> />
				<label for="word-posessive1">first person</label>
				<input type="radio" id="word-posessive2" name="flags[posession]" value="posessive 2nd person" <?= (isset($word->flags->posessive2))? 'checked="checked"':'' ?> />
				<label for="word-posessive2">second person</label>
				<input type="radio" id="word-posessive3" name="flags[posession]" value="posessive 3rd person" <?= (isset($word->flags->posessive3))? 'checked="checked"':'' ?> />
				<label for="word-posessive3">third person</label>
				
				<hr />
				<h3>Particles</h3>
				<input type="checkbox" id="word-also" name="flags[other]" value="also" <?= (isset($word->flags->also))? 'checked="checked"':'' ?> />
				<label for="word-also">also</label>
				<input type="checkbox" id="word-either" name="flags[other]" value="either" <?= (isset($word->flags->either))? 'checked="checked"':'' ?> />
				<label for="word-either">either</label>
				<input type="checkbox" id="word-interrogative" name="flags[other]" value="interrogative" <?= (isset($word->flags->interrogative))? 'checked="checked"':'' ?> />
				<label for="word-interrogative">interrogative</label>
				<input type="checkbox" id="word-emphasis" name="flags[other]" value="emphasis" <?= (isset($word->flags->emphasis))? 'checked="checked"':'' ?> />
				<label for="word-emphasis">emphasis</label>
			</p>
			
			<p>
				<div>
					<input type="submit" value="submit" />
				</div>
			</p>
		
		<?= form_close() ?>
	</div>
</div>