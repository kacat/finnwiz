<div id="page">
	<h1>Word bulk uploader</h1>

	<div class="content">
		
		<?= form_open(uri_string()) ?>
		
			<?php if(isset($word_added)){ ?>
				<p>The word was successfully added to the database</p>
			<?php } ?>
			
			<?php $i = 0; ?>
			
			<p>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="word" required /><br />
				<textarea class="medium-input" name="word[<?= $i ?>][data][translation]"  placeholder="in english" required></textarea>
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="nominative" />
			</p>
			<p>
				type: <select name="word[<?= $i ?>][data][type]" id="type">
					<option value="noun" >noun</option>
					<?php /*<option value="verb" <?= ($word && $word->type == 'verb')? 'selected="selected"':'' ?> >verb</option> */ ?>
					<option value="adjective" >adjective</option>
					<?php /*<option value="pronoun" <?= ($word && $word->type == 'pronoun')? 'selected="selected"':'' ?> >pronoun</option> */ ?>
					<?php /*<option value="numeral" <?= ($word && $word->type == 'numeral')? 'selected="selected"':'' ?> >numeral</option> */ ?>
				</select>
			</p>
			
			<p>
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="nominative plural" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="nominative" />
				<input type="hidden" name="word[<?= $i ?>][flags][other]" value="plural" />
				
				<hr />
				
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="accusative" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="accusative" />
				
				<hr />
				
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="genitive" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="genitive" />
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="genitive plural" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="genitive" />
				<input type="hidden" name="word[<?= $i ?>][flags][other]" value="plural" />
				
				<hr />
				
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="partitive" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="partitive" />
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="partitive plural" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="partitive" />
				<input type="hidden" name="word[<?= $i ?>][flags][other]" value="plural" />
				
				<hr />
				
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="illative (into)" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="illative" />
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="illative plural" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="illative" />
				<input type="hidden" name="word[<?= $i ?>][flags][other]" value="plural" />
				
				<hr />
				
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="inessive (in)" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="inessive" />
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="inessive plural" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="inessive" />
				<input type="hidden" name="word[<?= $i ?>][flags][other]" value="plural" />
				
				<hr />
				
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="elative (out of)" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="elative" />
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="elative plural" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="elative" />
				<input type="hidden" name="word[<?= $i ?>][flags][other]" value="plural" />
				
				<hr />
				
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="allative (onto)" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="allative" />
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="allative plural" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="allative" />
				<input type="hidden" name="word[<?= $i ?>][flags][other]" value="plural" />
				
				<hr />
				
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="adessive (on)" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="adessive" />
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="adessive plural" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="adessive" />
				<input type="hidden" name="word[<?= $i ?>][flags][other]" value="plural" />
				
				<hr />
				
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="ablative (off)" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="ablative" />
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="ablative plural" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="ablative" />
				<input type="hidden" name="word[<?= $i ?>][flags][other]" value="plural" />
				
				<hr />
				
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="essive (as a)" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="essive" />
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="essive plural" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="essive" />
				<input type="hidden" name="word[<?= $i ?>][flags][other]" value="plural" />
				
				<hr />
				
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="translative (become)" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="translative" />
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="translative plural" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="translative" />
				<input type="hidden" name="word[<?= $i ?>][flags][other]" value="plural" />
				
				<hr />
				
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="comitative (with) plural" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="comitative" />
				<input type="hidden" name="word[<?= $i ?>][flags][other]" value="plural" />
				
				<hr />
				
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="instructive (by means of)" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="instructive" />
				<?php $i++; ?>
				<input class="medium-input" type="text" name="word[<?= $i ?>][data][word]" value="" placeholder="instructive plural" />
				<input type="hidden" name="word[<?= $i ?>][flags][case]" value="instructive" />
				<input type="hidden" name="word[<?= $i ?>][flags][other]" value="plural" />
				
				
			</p>
			<p>
				<div>
					<input type="submit" value="submit" />
				</div>
			</p>
		
		<?= form_close() ?>
	</div>
</div>