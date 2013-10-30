<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scripts extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->helper('asset_helper');
		$this->load->helper('cookie');
	}
	
	public function index(){
		echo 'scripts/index';
	}
	
	public function check_verb(){
		
		if($this->input->post()){
			$sql = "SELECT * FROM verbs WHERE inf LIKE ?";
			$query = $this->db->query($sql, array($this->input->post('inf').'%'));
			
			if (!$this->input->post('inf')){
				$answer = array('type'=>'none');
			}else if ($query->num_rows() == 1){
				$row = $query->row();
				$answer = array(
					'type'=>'single',
					'id'=>$row->id,
					'inf'=>$row->inf
				);
			}else if($query->num_rows() > 1){
				$answer = array(
					'type'=>'list'
				);
				$html = '';
				foreach ($query->result() as $row){
					$html .= '<option class="key_enter" value="'.$row->inf.'" />';
				}
				$answer['html'] = $html;
			}else{
				$answer = array(
					'type'=>'none'
				);
			}
			echo json_encode($answer);
			
		}
		
	}
	
	public function load_verb(){
		if($this->input->post()){
			$sql = "SELECT * FROM verbs WHERE id = ?";
			$query = $this->db->query($sql, array($this->input->post('id')));
			$row = $query->row();
			
			$answer = array(
				'id' => $row->id,
				'type' => $row->type,
				'eng' => $row->info,
				's1'=>'', 's2'=>'', 's3'=>'', 'p1'=>'', 'p2'=>'', 'p3'=>'', 'passive'=>''
			);
			
			$sql = "SELECT * FROM verb_conjugator WHERE verb_id = ? AND mood = ? AND tense = ? AND form = ?";
			$query = $this->db->query($sql, array($this->input->post('id'), $this->input->post('mood'), $this->input->post('tense'), $this->input->post('form')));
			foreach ($query->result() as $row){
				if ($row->person_nbr == 'single') $answer['s'.$row->person] = $row->value;
				if ($row->person_nbr == 'plural') $answer['p'.$row->person] = $row->value;
				if ($row->person_nbr == 'passive') $answer['passive'] = $row->value;
			}
			
			echo json_encode($answer);
		}
	}
	
	public function save_verb(){
		if($this->input->post()){
			if($this->input->post('id')){
				$id = $this->input->post('id');
				$sql = "UPDATE verbs SET type = ?, info = ? WHERE id = ?";
				$query = $this->db->query($sql, array($this->input->post('type'), $this->input->post('eng'), $this->input->post('id')));
			}else{
				$sql = "INSERT INTO verbs (inf, type, info) VALUES (?,?,?)";
				$query = $this->db->query($sql, array($this->input->post('inf'), $this->input->post('type'), $this->input->post('eng')));
				$id = mysql_insert_id();
			}
			
			$mood = $this->input->post('mood');
			$tense = $this->input->post('tense');
			$form = $this->input->post('form');
			
			$conjugate = array();
			
			foreach($this->input->post('con') as $cid=>$cval){
				switch($cid){
					case 1:
						$person = '1';
						$person_nbr = 'single';
						break;
					case 2:
						$person = '2';
						$person_nbr = 'single';
						break;
					case 3:
						$person = '3';
						$person_nbr = 'single';
						break;
					case 4:
						$person = '1';
						$person_nbr = 'plural';
						break;
					case 5:
						$person = '2';
						$person_nbr = 'plural';
						break;
					case 6:
						$person = '3';
						$person_nbr = 'plural';
						break;
				}
				
				$conjugate[] = array(
					'person' => $person,
					'person_nbr' => $person_nbr,
					'value' => $cval
				);
			}
			
			$conjugate[] = array(
				'person' => 'passive',
				'person_nbr' => 'passive',
				'value' => $this->input->post('passive')
			);
			
			foreach ($conjugate as $crow){
				$sql = "SELECT id FROM verb_conjugator WHERE verb_id = ? AND mood = ? AND tense = ? AND person = ? AND person_nbr = ? AND form = ? ";
				$query = $this->db->query($sql, array($id, $mood, $tense, $crow['person'], $crow['person_nbr'], $form));
				
				if($query->num_rows()){
					$row = $query->row();
					$sql = "UPDATE verb_conjugator SET value = ? WHERE id = ?";
					$query = $this->db->query($sql, array($crow['value'], $row->id));
					
				}else{
					$sql = "INSERT INTO verb_conjugator (verb_id, mood, tense, person, person_nbr, form, value)
							VALUES (?, ?, ?, ?, ?, ?, ?)";
					$query = $this->db->query($sql, array($id, $mood, $tense, $crow['person'], $crow['person_nbr'], $form, $crow['value']));
				}
			}
			
			echo json_encode(array('script'=>'success', 'id'=>$id));
		}
	}

	public function check_sentence(){
		$this->load->model('sentencer');
		$resp = $this->sentencer->check_sentence();
		//echo json_encode(array('info'=>$resp));
		var_dump ($resp);
	}
}