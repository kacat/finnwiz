<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {
	
	var $id;
	var $item;
	var $list;
	
	function __construct() {
		parent::__construct();
	}
	
	function load($id, $return_result = FALSE){
		$query = $this->db->get_where('user',array('id'=>$id, 'active'=>1));
		if(!$query) return FALSE;
		
		if(!$return_result){
			$this->id = $id;
			$this->item = $query->row();
			return $this;
		}
		
		return $query->row();
	}
	
	function get($id){
		return $this->load($id, TRUE);
	}
	
	function add($data){
		$result = stdClass();
		
		//check username
		$query = $this->db->get_where('user',array('username'=>$data->username));
		if ($query->db->num_rows()){
			$result->error = TRUE;
			$result->error_message = 'This username already exists';
			return $result;
		}
		
		//check email
		$query = $this->db->get_where('user',array('email'=>$data->email));
		if ($query->db->num_rows()){
			$result->error = TRUE;
			$result->error_message = 'This email address is already in use';
			return $result;
		}

		//add user
		$data->active = 1;
		$data->password = md5($data->password);
		$this->db->set('registered_date', 'NOW()', FALSE);
		$query = $this->db->insert('user',$data);
		
		$result->success = TRUE;
		$result->user_id = $this->db->insert_id();
		return $result;
		
	}
	
	function validate_login(){
		//check password
		$sql = "SELECT id FROM user WHERE ('username' = ? OR 'email' = ?) AND password = ? AND active = 1"; 
		$query = $this->db->query($sql,array('username'=>$this->input->post('username'), 'email'=>$this->input->post('username'), 'password'=>md5($this->input->post('password'))));
		if ($query->db->num_rows() != 1){
			$result->error = TRUE;
			$result->error_message = 'Invalid username or password';
			return $result;
		}
		$user_data = $query->row();
		
		$this->login($user_data->id);
		
		$result->success = TRUE;
		return $result;
	}
	
	function login($id){
		$this->load($id);
		
		$session_data = array(
			'user_id' => $this->id,
			'user_session' => md5($this->data->id.mktime().'suolajapippuri'),
			'username' => $this->data->username,
			'is_logged_in' => true
		);
		
		$this->session->set_userdata($session_data);
		
		//sets the last_login_date
		$this->db->set('last_login_date','NOW()',FALSE);
		$this->db->update('user', array(), array('id'=>$id));
		
		return;
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		header('Location: '.base_url());
		return;
	}
	
	function validate_register(){
		
		if(!$this->input->post()) return '';
		
		$this->load->library('form_validation');
		
		//validates the post data
		$this->form_validation->set_rules('register-email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('register-password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('register-password-confirm', 'Password confirmation', 'trim|required|matches[register-password]');
		$this->form_validation->set_rules('register-first-name', 'First name', 'trim|strip_tags|required');
		$this->form_validation->set_rules('register-last-name', 'Last name', 'trim|strip_tags|required');
		
		if ($this->form_validation->run() == FALSE) return validation_errors('<li>','</li>');
		
		return $this->register($this->input->post());
		
	}
	
	
}
