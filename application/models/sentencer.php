<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sentencer extends CI_Model {
	
	var $id;
	var $item;
	
	function __construct() {
		parent::__construct();
	}
	
	function load($id){
		$this->id = $id;
		
		$query = $this->db->query('SELECT * FROM sentencer WHERE id = ?',array('id'=>$id));
		$this->item = ($query)? $query->row():'';
		
		return $this;
	}
	
	function check_sentence(){
		if(!$this->input->post()) return 'no data';
		
		$sentencer = $this->load($this->input->post('id'));
		$solution = strtolower(preg_replace('/[^A-Za-z0-9-]/', '', $this->input->post('sentencer_translation')));
		
		$subs = array();
		$sentence = $this->item->finnish;
		
		if (strpos($sentence, '[') !== FALSE){
			do {
				
				$substr = substr($sentence, strpos($sentence, '['), strpos($sentence, ']')-strpos($sentence, '[')+1);
				$sentence = substr($sentence, strpos($sentence, ']')+1);
				
				$substr_comma = substr($substr, 1, strlen($substr)-2);
				$substr_array = explode(',', $substr_comma);
				
				if ($substr){
					$subs[] = array(
						'pattern'=>$substr,
						'values'=>$substr_array
					);
				}
				
			} while(strpos($sentence,'['));
		}
		
		$sentences = array(
			$this->item->finnish
		);
		
		foreach($subs as $sub){
			$newsentences = array();
			foreach ($sub['values'] as $val){
				foreach ($sentences as $sentence){
					$newsentences[] = str_replace($sub['pattern'], $val, $sentence);
				}
			}
			$sentences = $newsentences;
		}
		
		$result = 'wrong';
		$info = '';
		$bestmatch = '';
		$bestmatch_percent = 100;
		foreach($sentences as $sentence){
			if (strtolower(preg_replace('/[^A-Za-z0-9-]/', '', $sentence)) ==  $solution) $result = 'right';
			
			$percent = levenshtein(strtolower(str_replace(' ', '', $sentence)), $solution);
			if ($percent < $bestmatch_percent){
				$bestmatch_percent = $percent;
				$bestmatch = $sentence;
			}
			
		}
		
		if ($result == 'right') return array('result'=>TRUE);
		else return array('result'=>FALSE,'bestmatch'=>$bestmatch,'score'=>$bestmatch_percent);
	}

	function get_random_sentence(){
		$count = $this->db->count_all('sentencer');
		
		return rand(1, $count);
	}
}

?>