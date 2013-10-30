<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wordwiz extends CI_Model {
	
	var $id;
	var $item;
	private $vowels = array('a','ä','å','e','i','o','ö','u','y');
	private $lowvowels = array('a','å','o','u');
	
	function __construct() {
		parent::__construct();
	}
	
	function create($word, $return = FALSE){
		
		
		$this->make_genitive($word);
		$this->make_genitive_plural($word);
		$this->make_partitive($word);
		//$this->make_partitive_plural($word);
		
		return $this;
	}
	
	function make_genitive($word){
		
		$cap = $this->check_capital($word);
		$word = strtolower($word);
		$stem = $this->degrade($word);
		
		$genitive = '';
		
		if($this->substr_unicode($word, -3, 3) == 'nen'){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-3).'sen';
		}
		
		else if($this->substr_unicode($word, -1, 1) == 'e'){
			$genitive = $stem.'en';
		}

		else if($this->substr_unicode($word, -2, 2) == 'si'){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-2).'den';
		}

		else if($this->substr_unicode($word, -1, 1) == 'i'){
			$genitive1 = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'en';
			$genitive2 = $stem.'n';
			
			$genitive1 = $this->recapitalize($genitive1, $cap);
			$genitive2 = $this->recapitalize($genitive2, $cap);
			$genitive = $genitive1 . ' or ' . $genitive2;
		}
		
		else if (in_array($this->substr_unicode($word, -1, 1), array('a','ä','å','o','ö','u','y'))){
			$genitive = $stem.'n';
		}
		
		else if($this->substr_unicode($word, -2, 2) == 'in'){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-2).'imen';
		}
		
		else if($this->substr_unicode($word, -3, 3) == 'ton'){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-3).'ttoman';
		}
		
		else if($this->substr_unicode($word, -2, 2) == 'is'){
			$genitive1 = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-2).'iin';
			$genitive2 = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-2).'iksen';
			
			$genitive1 = $this->recapitalize($genitive1, $cap);
			$genitive2 = $this->recapitalize($genitive2, $cap);
			$genitive = $genitive1 . ' or ' . $genitive2;
		}
		
		else if($this->substr_unicode($word, -2, 2) == 'as'){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'an';
		}
		
		else if($this->substr_unicode($word, -2, 2) == 'äs'){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'än';
		}
		
		else if (in_array($this->substr_unicode($word, -2, 2), array('us','ys'))){
			$genitive1 = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'ksen';
			$genitive2 = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'den';
			
			$genitive1 = $this->recapitalize($genitive1, $cap);
			$genitive2 = $this->recapitalize($genitive2, $cap);
			$genitive = $genitive1 . ' or ' . $genitive2;
		}
		
		else if (in_array($this->substr_unicode($word, -3, 3), array('uus','yys'))){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'den';
		}
		
		else if (in_array($this->substr_unicode($word, -2, 2), array('os','ös'))){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'ksen';
		}
		
		else if($this->substr_unicode($word, -2, 2) == 'es'){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'ksen';
		}
		
		else if($this->substr_unicode($word, -3, 3) == 'tar'){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-3).'ttaren';
		}
		
		else if($this->substr_unicode($word, -3, 3) == 'tär'){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-3).'ttären';
		}
		
		else if (in_array($this->substr_unicode($word, -2, 2), array('el','en','er','ar'))){
			$genitive = $stem.'en';
		}
		
		else{
			$genitive = $stem.'in';
		}
		
		$genitive = $this->recapitalize($genitive, $cap);
		$this->item->genitive = $genitive;
		
	}

	function make_genitive_plural($word){
		
		$cap = $this->check_capital($word);
		$word = strtolower($word);
		$stem = $this->degrade($word);
		
		$genitive = '';
		
		if($this->substr_unicode($word, -3, 3) == 'nen'){
			$genitive1 = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-3).'sten';
			$genitive2 = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-3).'sien';
			
			$genitive1 = $this->recapitalize($genitive1, $cap);
			$genitive2 = $this->recapitalize($genitive2, $cap);
			$genitive = $genitive1 . ' or ' . $genitive2;
		}
		
		else if ($this->isConsonant($this->substr_unicode($word, -2, 1)) && in_array($this->substr_unicode($word, -1, 1), array('o','ö','u','y'))){
			$genitive = $stem.'jen';
		}
		
		else if($this->substr_unicode($word, -1, 1) == 'e'){
			$genitive1 = $stem.'iden';
			$genitive2 = $stem.'ittenn';
			
			$genitive1 = $this->recapitalize($genitive1, $cap);
			$genitive2 = $this->recapitalize($genitive2, $cap);
			$genitive = $genitive1 . ' or ' . $genitive2;
		}

		else if($this->substr_unicode($word, -1, 1) == 'i'){
			$genitive = $stem.'en';
		}
		
		else if($this->substr_unicode($word, -1, 1) == 'ä'){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'ien';
		}
		
		else if($this->strlen_unicode($word) <= 3){
			$stem = $this->substr_replace_unicode($stem, '', $this->strlen_unicode($stem)-2, 1);
			$genitive = $stem.'iden';
		}
		
		else if($this->substr_unicode($word, -1, 1) == 'a' && in_array($this->first_vowel($word), array('a','e','i'))){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'ojen';
		}
		
		else if($this->substr_unicode($word, -1, 1) == 'a' && in_array($this->first_vowel($word), array('o','y'))){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'ien';
		}
		
		else if($this->substr_unicode($word, -2, 2) == 'in'){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'mien';
		}
		
		//
		
		else if($this->substr_unicode($word, -3, 3) == 'ton'){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-3).'ttomien';
		}
		
		else if($this->substr_unicode($word, -2, 2) == 'is'){
			$genitive1 = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-2).'iiden';
			$genitive2 = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-2).'iksien';
			
			$genitive1 = $this->recapitalize($genitive1, $cap);
			$genitive2 = $this->recapitalize($genitive2, $cap);
			$genitive = $genitive1 . ' or ' . $genitive2;
		}
		
		else if(in_array($this->substr_unicode($word, -2, 2), array('as','äs'))){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'iden';
		}
		
		else if (in_array($this->substr_unicode($word, -2, 2), array('us','ys','os','ös'))){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'ksien';
		}
		
		else if (in_array($this->substr_unicode($word, -3, 3), array('uus','yys'))){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'ksien';
		}
		
		else if($this->substr_unicode($word, -2, 2) == 'es'){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-1).'ksien';
		}
		
		else if($this->substr_unicode($word, -3, 3) == 'tar'){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-3).'ttarien';
		}
		
		else if($this->substr_unicode($word, -3, 3) == 'tär'){
			$genitive = $this->substr_unicode($stem, 0, $this->strlen_unicode($stem)-3).'ttärien';
		}
		
		else if (in_array($this->substr_unicode($word, -2, 2), array('el','en','er','ar'))){
			$genitive = $stem.'ien';
		}
		
		else{
			$genitive = $stem.'ien';
		}
		
		$genitive = $this->recapitalize($genitive, $cap);
		$this->item->genitive_plural = $genitive;
		
	} 

	function make_partitive($word){
		
		$cap = $this->check_capital($word);
		$word = strtolower($word);
		//$stem = $this->degrade($word);
		$isHigh = $this->is_high($word);
		
		$partitive = '';
		
		if($this->substr_unicode($word, -3, 3) == 'nen'){
			$ending = ($isHigh)? 'stä':'sta';
			$partitive = $this->substr_unicode($word, 0, $this->strlen_unicode($word)-3).$ending;
		}
		
		else if($this->substr_unicode($word, -1, 1) == 'e'){
			$ending = ($isHigh)? 'ttä':'tta';
			$partitive = $word.$ending;
		}
		
		else if($this->isVowel($this->substr_unicode($word, -2, 1)) && $this->isConsonant($this->substr_unicode($word, -1, 1))){
			$ending = ($isHigh)? 'tä':'ta';
			$partitive = $word.$ending;
		}
		
		else if($this->isVowel($this->substr_unicode($word, -2, 1)) && $this->isVowel($this->substr_unicode($word, -1, 1))){
			$ending = ($isHigh)? 'tä':'ta';
			$partitive = $word.$ending;
		}
		
		else if (in_array($this->substr_unicode($word, -1, 1), array('a','o','u','ä','ö','y'))){
			$ending = ($isHigh)? 'ä':'a';
			$partitive = $word.$ending;
		}
		
		else if($this->substr_unicode($word, -2, 2) == 'si'){
			$ending = ($isHigh)? 'ttä':'tta';
			$partitive = $this->substr_unicode($word, 0, $this->strlen_unicode($word)-2).$ending;
		}
		
		else if (in_array($this->substr_unicode($word, -2, 2), array('ni','li','ri'))){
			$ending = ($isHigh)? 'tä':'ta';
			$partitive = $this->substr_unicode($word, 0, $this->strlen_unicode($word)-1).$ending;
		}

		else if($this->substr_unicode($word, -1, 1) == 'i'){
			$ending = ($isHigh)? 'ä':'a';
			$partitive1 = $word.$ending;
			$partitive2 = $this->substr_unicode($word, 0, $this->strlen_unicode($word)-1).'e'.$ending;
			
			$partitive1 = $this->recapitalize($partitive1, $cap);
			$partitive2 = $this->recapitalize($partitive2, $cap);
			$partitive = $partitive1 . ' or ' . $partitive2;
		}
		
		$partitive = $this->recapitalize($partitive, $cap);
		$this->item->partitive = $partitive;
		
	}

	function make_partitive_plural($word){
		
		$cap = $this->check_capital($word);
		$word = strtolower($word);
		$isHigh = $this->is_high($word);
		
		$partitive = '';
		
		if($this->substr_unicode($word, -3, 3) == 'nen'){
			$ending = ($isHigh)? 'siä':'sia';
			$partitive = $this->substr_unicode($word, 0, $this->strlen_unicode($word)-3).$ending;
		}
		
		else if($this->substr_unicode($word, -1, 1) == 'e'){
			$ending = ($isHigh)? 'ttä':'tta';
			$partitive = $word.$ending;
		}
		
		else if($this->isVowel($this->substr_unicode($word, -2, 1)) && $this->isConsonant($this->substr_unicode($word, -1, 1))){
			$ending = ($isHigh)? 'tä':'ta';
			$partitive = $word.$ending;
		}
		
		else if($this->isVowel($this->substr_unicode($word, -2, 1)) && $this->isVowel($this->substr_unicode($word, -1, 1))){
			$ending = ($isHigh)? 'tä':'ta';
			$partitive = $word.$ending;
		}
		
		else if (in_array($this->substr_unicode($word, -1, 1), array('a','o','u','ä','ö','y'))){
			$ending = ($isHigh)? 'ä':'a';
			$partitive = $word.$ending;
		}
		
		else if($this->substr_unicode($word, -2, 2) == 'si'){
			$ending = ($isHigh)? 'ttä':'tta';
			$partitive = $this->substr_unicode($word, 0, $this->strlen_unicode($word)-2).$ending;
		}
		
		else if (in_array($this->substr_unicode($word, -2, 2), array('ni','li','ri'))){
			$ending = ($isHigh)? 'tä':'ta';
			$partitive = $this->substr_unicode($word, 0, $this->strlen_unicode($word)-1).$ending;
		}

		else if($this->substr_unicode($word, -1, 1) == 'i'){
			$ending = ($isHigh)? 'ä':'a';
			$partitive1 = $word.$ending;
			$partitive2 = $this->substr_unicode($word, 0, $this->strlen_unicode($word)-1).'e'.$ending;
			
			$partitive1 = $this->recapitalize($partitive1, $cap);
			$partitive2 = $this->recapitalize($partitive2, $cap);
			$partitive = $partitive1 . ' or ' . $partitive2;
		}
		
		$partitive = $this->recapitalize($partitive, $cap);
		$this->item->partitive_plural = $partitive;
		
	} 
	
	
	// ----- HELPER FUNCTIONS
	
	private function isVowel($c){
		$c = strtolower($c);
        return in_array($c, $this->vowels);
	}
	
	private function isConsonant($c){
		$c = strtolower($c);
		if (ctype_alpha($c) && !$this->isVowel($c)) return TRUE;
		return FALSE;
	}
	
	private function substr_unicode($str, $s, $l = null) {
	    return join("", array_slice(
	        preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY), $s, $l));
	}
	
	private function substr_replace_unicode($original, $replacement, $position, $length){
		$startString = mb_substr($original, 0, $position, "UTF-8");
		$endString = mb_substr($original, $position + $length, mb_strlen($original), "UTF-8");
 
		$out = $startString . $replacement . $endString;
 
		return $out;
	}
	
	private function strlen_unicode($str){
		return mb_strlen($str, "UTF-8");
	}
	
	private function check_capital($str) {
		$chr = mb_substr ($str, 0, 1, "UTF-8");
		return mb_strtolower($chr, "UTF-8") != $chr;
	}
	
	private function recapitalize($str, $cap) {
		if ($cap) {
			$capstr = mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr($str, 1);
			return $capstr;
		}
		else return $str;
	}
	
	private function degrade($word){
		//walk through the word to find the last consonant grouping
		
		$grp = '';
		$done = false;
		$wordlength = $this->strlen_unicode($word)-1;
		$cnt = $wordlength;
		$ind = false;
		$degraded = $word;
		
		while (!$done && $cnt >= 0){
			
			//echo 'char: '.$this->substr_unicode($word, $cnt, 1).'<br />';
			//check character at counter
			if ($this->isConsonant($this->substr_unicode($word, $cnt, 1)) && $cnt<$wordlength) {
				$grp .= $this->substr_unicode($word, $cnt, 1);
				if (!$ind) $ind = $cnt;
			}
			else if ($this->isVowel($this->substr_unicode($word, $cnt, 1)) && $grp) {
				$done = TRUE;
			}
			$cnt --;
		}
		
		if ($cnt < 0) return $word;
		
		$grp = strrev($grp);
		
		//degrade table
		if(substr($grp, -2, 2) == 'kk') $degraded = $this->substr_replace_unicode($word, 'k', $ind-1, 2);
		else if(substr($grp, -2, 2) == 'pp') $degraded = $this->substr_replace_unicode($word, 'p', $ind-1, 2);
		else if(substr($grp, -2, 2) == 'tt') $degraded = $this->substr_replace_unicode($word, 't', $ind-1, 2);
		
		else if(substr($grp, -2, 2) == 'nt') $degraded = $this->substr_replace_unicode($word, 'nn', $ind-1, 2);
		else if(substr($grp, -2, 2) == 'nk') $degraded = $this->substr_replace_unicode($word, 'ng', $ind-1, 2);
		
		else if(substr($grp, -2, 2) == 'lt') $degraded = $this->substr_replace_unicode($word, 'll', $ind-1, 2);
		else if(substr($grp, -2, 2) == 'rt') $degraded = $this->substr_replace_unicode($word, 'rr', $ind-1, 2);
		
		else if(substr($grp, -2, 2) == 'mp') $degraded = $this->substr_replace_unicode($word, 'mm', $ind-1, 2);
		
		else if($this->substr_unicode($word, $ind-1, 3) == 'lki') $degraded = $this->substr_replace_unicode($word, 'lje', $ind-1, 3);
		else if($this->substr_unicode($word, $ind-1, 3) == 'rki') $degraded = $this->substr_replace_unicode($word, 'rje', $ind-1, 3);
		
		else if(substr($grp, -2, 2) == 'rk') $degraded = $this->substr_replace_unicode($word, 'r', $ind-1, 2);
		else if(substr($grp, -2, 2) == 'lk') $degraded = $this->substr_replace_unicode($word, 'l', $ind-1, 2);
		
		else if(substr($grp, -1, 1) == 't') $degraded = $this->substr_replace_unicode($word, 'd', $ind, 1);
		else if(substr($grp, -1, 1) == 'p') $degraded = $this->substr_replace_unicode($word, 'v', $ind, 1);
		else if(substr($grp, -1, 1) == 'k') $degraded = $this->substr_replace_unicode($word, 'v', $ind, 1);
		
		return $degraded;
	}
	
	private function is_high($word){
		
		$wordlength = $this->strlen_unicode($word);
		$cnt = 0;
		
		while ($cnt < $wordlength){
			if (in_array($this->substr_unicode($word, $cnt, 1), $this->lowvowels)) {
				return FALSE;
			}
			$cnt ++;
		}
		return TRUE;
	}
	
	private function first_vowel($word){
		$wordlength = $this->strlen_unicode($word);
		$cnt = 0;
		
		while ($cnt < $wordlength){
			if ($this->isVowel($this->substr_unicode($word, $cnt, 1))) {
				return $this->substr_unicode($word, $cnt, 1);
			}
			$cnt ++;
		}
		return '';
	}
}

?>