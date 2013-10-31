<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Js_scripts extends Ajax_Controller {
	
	public function check_sentence(){
		$this->load->model('sentencer');
		$resp = $this->sentencer->check_sentence();
		//echo json_encode(array('info'=>$resp));
		$this->json_data['error'] = 0;
		$this->json_data['info'] = $resp;
	}
	
	public function check_suffix(){
		$this->load->model('suffixer');
		$resp = $this->suffixer->check_suffix();
		//echo json_encode(array('info'=>$resp));
		$this->json_data['error'] = 0;
		$this->json_data['info'] = $resp;
	}
}