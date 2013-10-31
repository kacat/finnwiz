<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Word extends CI_Model {
	
	var $id;
	var $item;
	var $list;
	
	function __construct() {
		parent::__construct();
	}
	
	function load($id, $return = FALSE){
		
		$query = $this->db->query('SELECT * FROM dictionary WHERE id = ? AND active = 1',array('id'=>$id));
		$item = ($query)? $query->row():FALSE;
		
		if ($item){
			
			//add flags
			$query = $this->db->query('SELECT T.name, T.definition FROM dictionary_flags F INNER JOIN dictionary_flag_types T ON T.id = F.flag_id WHERE F.word_id = ? AND F.active = 1 AND T.active = 1',array('word_id'=>$id));
			
			if($query) {
				$item->flags = $query->result();
			}else $item->flags = FALSE;
			
			if (!$item->ref_id){
				$inf_query = $this->db->query('SELECT D.id FROM dictionary D WHERE D.ref_id = ? AND D.active = 1',array('id'=>$id));
				
				if($inf_query) {
					$inf_holder = array();
					foreach($inf_query->result() as $inflection){
						$inflection_data = $this->load($inflection->id, TRUE);
						$index = '';
						foreach($inflection_data->flags as $flag){
							$index .= '_'.$flag->name;
						}
						
						$inf_holder[$index] = $inflection_data;
					}
					
					$item->inflections = (object) $inf_holder;
					
				}else{
					$item->inflections = FALSE;
				}
			}
			
		}
		
		if ($return) return $item;
		
		$this->id = $id;
		$this->item = $item;
		
		return $this;
	}

	function find($word){
		
		$query = $this->db->query('SELECT * FROM dictionary WHERE word LIKE ? AND active = 1',array('word'=>$word));
		
		if(!$query) return FALSE;
		
		foreach($query->result() as $row){
			$item = $row;
			
			//add flags
			$query = $this->db->query('SELECT T.name, T.definition FROM dictionary_flags F INNER JOIN dictionary_flag_types T ON T.id = F.flag_id WHERE F.word_id = ? AND F.active = 1 AND T.active = 1',array('word_id'=>$row->id));
			if($query) {
				$item->flags = $query->result();
			}else $item->flags = FALSE;
			
			if ($item->ref_id){
				$query = $this->db->query('SELECT * FROM dictionary WHERE id = ? AND active = 1',array('id'=>$item->ref_id));
				$item->ref = ($query)? $query->row():FALSE;
				
				$ref_id = $item->ref_id;
			}else{
				$ref_id = $item->id;
			}
			
			$inf_query = $this->db->query('SELECT D.id FROM dictionary D WHERE D.ref_id = ? AND D.active = 1',array('id'=>$ref_id));
			
			if($inf_query) {
				$inf_holder = array();
				foreach($inf_query->result() as $inflection){
					//$inf_holder[] = $this->load($inflection->id, TRUE);
					
					$inflection_data = $this->load($inflection->id, TRUE);
					$index = '';
					foreach($inflection_data->flags as $flag){
						$index .= '_'.$flag->name;
					}
						
					$inf_holder[$index] = $inflection_data;
				}
				if ($item->ref_id) $item->ref->inflections = (object) $inf_holder;
				else $item->inflections = (object) $inf_holder;
				
			}else{
				if ($item->ref_id) $item->ref->inflections = FALSE;
				else $item->inflections = FALSE;
			}
			
			$this->list[] = $item;
		}

		if (count($this->list) == 1 ){
			$this->id = $this->list[0]->id;
			$this->item = $this->list[0];
		}
		
		return $this;
	}

	function findID($word){
		$query = $this->db->query('SELECT id FROM dictionary WHERE word LIKE ? AND active = 1 AND ref_id = 0',array('word'=>$word));
		
		if(!$query) return FALSE;
		
		return $query->row()->id;
	}
	
	function add($data, $flags){
		//check if the word already exists
		//$query = $this->db->query('SELECT id FROM dictionary WHERE word = ? AND active = 1',array('word'=>$data['word']));
		//if($query->num_rows()) return 'EXISTS';
		
		$data['active'] = 1;
		$insert = $this->db->insert('dictionary', $data);
		$id = $this->db->insert_id();
		
		foreach($flags as $flag){
			$flag_id = $this->get_flag_id($flag);
			$insert = $this->db->insert('dictionary_flags', array('word_id'=>$id,'flag_id'=>$flag_id,'active'=>1));
		}

		return $id;
	}
	
	function update($id, $data, $flags){
		$update = $this->db->update('dictionary', $data, array('id'=>$id));
			
		$update = $this->db->update('dictionary_flags', array('active'=>1), array('word_id'=>$id));
		
		foreach($flags as $flag){
			$flag_id = $this->get_flag_id($flag);
			$query = $this->db->query('SELECT id FROM dictionary_flags WHERE word_id = ? AND flag_id = ?',array('word_id'=>$id, 'flag'=>$flag_id));
			if ($query->num_rows()){
				$update = $this->db->update('dictionary_flags', array('active'=>1), array('id'=>$query->row()->id));
			}else{
				$insert = $this->db->insert('dictionary_flags', array('word_id'=>$id,'flag_id'=>$flag_id,'active'=>1));	
			}
		}
		
		return TRUE;
	}

	function get_flag_id($name){
		$query = $this->db->query('SELECT id FROM dictionary_flag_types WHERE name LIKE ?', array('name'=>$name));
		if ($query->num_rows()) return $query->row()->id;
		else{
			$this->db->insert('dictionary_flag_types', array('name'=>$name, 'active'=> 1));
			return $this->db->insert_id();
		}
	}
	
	function get_letters(){
		$query = $this->db->query('SELECT DISTINCT LEFT(word, 1) AS letter FROM dictionary WHERE ref_id = 0 ORDER BY letter');
		
		if(!$query) return FALSE;
		
		return $query->result();
	}
	
	function get_words_by_letter($letter){
		$query = $this->db->query("SELECT * FROM dictionary WHERE ref_id = 0 AND word LIKE '".$letter.".%' ORDER BY word");
		
		if(!$query) return FALSE;
		
		return $query->result();
	}
	
	function get_wordlist(){
		$query = $this->db->query("SELECT * FROM dictionary ORDER BY word");
		
		if(!$query) return FALSE;
		
		return $query->result();
	}
	
}

?>