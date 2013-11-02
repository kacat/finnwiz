<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suffixer extends CI_Model {
	
	var $id;
	var $item;
	
	function __construct() {
		parent::__construct();
	}
	
	function load($id){
		$this->id = $id;
		
		$query = $this->db->query('SELECT * FROM  dictionary WHERE id = ?',array('id'=>$id));
		if (!$query) return FALSE;
		
		$item = $query->row();
		if ($item){
			$this->item->translation = $item->translation;
			$query = $this->db->query('SELECT word FROM dictionary WHERE id = ?',array('id'=>$item->ref_id));
			$this->item->orig = $query->row()->word;
			
			$query = $this->db->query('SELECT T.name, T.definition FROM dictionary_flags F INNER JOIN dictionary_flag_types T ON T.id = F.flag_id WHERE F.word_id = ? AND F.active = 1 AND T.active = 1',array('word_id'=>$id));
			$this->item->flags = $query->result();
			
		}
	
		return $this;
	}
	
	function check_suffix(){
		if(!$this->input->post()) return 'no data';
		
		$query = $this->db->query('SELECT * FROM  dictionary WHERE id = ?',array('id'=>$this->input->post('id')));
		$item = $query->row();
		
		$answer = strtolower(preg_replace('/[^A-Za-z0-9-]/', '', $this->input->post('suffixer_translation')));
		
		$solutionstring = str_replace(' ','',$item->word);
		$solutionstring = str_replace(')','',$solutionstring);
		
		if (strpos($solutionstring,';')) $solutions = explode(';',$solutionstring);
		else if (strpos($solutionstring,'(')) $solutions = explode('(',$solutionstring);
		else if (strpos($solutionstring,',')) $solutions = explode('(',$solutionstring);
		else $solutions = explode(' ',$solutionstring);
		
		$result = 'wrong';
		$info = '';
		$bestmatch = '';
		$bestmatch_percent = 100;
		
		foreach($solutions as $solution){
			if (strtolower(preg_replace('/[^A-Za-z0-9-]/', '', $solution)) ==  $answer) $result = 'right';
			
			$percent = levenshtein(strtolower($solution), $answer);
			if ($percent < $bestmatch_percent){
				$bestmatch_percent = $percent;
				$bestmatch = $solution;
			}
		}
		
		if ($result == 'right') return array('result'=>TRUE);
		else return array('result'=>FALSE,'bestmatch'=>$bestmatch,'score'=>$bestmatch_percent);
	}

	function get_random_word(){
		$query = $this->db->query("SELECT id FROM dictionary WHERE ref_id > 0 AND active = 1");
		
		$index = rand(1, $query->num_rows());
		$idlist = $query->result();
		
		return $idlist[$index]->id;
	}
}

?>