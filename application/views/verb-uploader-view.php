<div id="page">
	<h1>Verb uploader</h1>

	<div class="content">
		
		<form id="verb-upload-form" name="verb-upload-form" action="javascript:saveVerb();" method="POST">
			<p>
				<input class="medium-input" list="inf-list" type="text" id="inf" name="inf" value="" placeholder="infinitive" required onkeyup="checkVerb();"/>
				<span id="inf-data">not found</span>
				<input type="hidden" name="id" id="inf-id" value="" />
			</p>
			<p>
				type: <input type="number" id="type" name="type" min="1" max="4" value="1" />
				<input class="medium-input" type="text" id="eng" name="eng" value="" placeholder="in english" required/>
				
				<datalist id="inf-list">
				</datalist>
			</p>
			
			<p>
				mood: <select name="mood" id="mood" onchange="loadVerb($('#inf-id').val());">
					<option value="indicative">indicative</option>
					<option value="conditional">conditional</option>
					<option value="potential">potential</option>
					<option value="imperative">imperative</option>	
				</select>
				
				tense: <select name="tense" id="tense" onchange="loadVerb($('#inf-id').val());">
					<option value="present">present</option>
					<option value="imperfect">imperfect</option>
					<option value="perfect">perfect</option>
					<option value="pluperfect">pluperfect</option>	
				</select>
				
				form: <select name="form" id="form" onchange="loadVerb($('#inf-id').val());">
					<option value="affirmative">affirmative</option>
					<option value="negative">negative</option>	
				</select>
			</p>
			
			<p>
				<div>
					<input class="medium-input" type="text" id="s1" name="con[1]" value="" placeholder="1st singular" />
				</div>
				<div>
					<input class="medium-input" type="text" id="s2" name="con[2]" value="" placeholder="2nd singular" />
				</div>
				<div>
					<input class="medium-input" type="text" id="s3" name="con[3]" value="" placeholder="3rd singular" />
				</div>
				<div>
					<input class="medium-input" type="text" id="p1" name="con[4]" value="" placeholder="1st plural" />
				</div>
				<div>
					<input class="medium-input" type="text" id="p2" name="con[5]" value="" placeholder="2nd plural" />
				</div>
				<div>
					<input class="medium-input" type="text" id="p3" name="con[6]" value="" placeholder="3rd plural" />
				</div>
			</p>
			
			<p>
				<div>
					<input class="medium-input" type="text" id="passive" name="passive" value="" placeholder="passive" />
				</div>
			</p>
			
			<p>
				<div>
					<input type="submit" value="submit" />
				</div>
			</p>
		
		</form>
	</div>
</div>