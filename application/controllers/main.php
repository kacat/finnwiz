<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->helper('asset_helper');
		$this->load->helper('cookie');
		$this->load->helper('form');
		$this->load->helper('general');
	}
	
	private function _header($additional_data = array()){
		
		//MAIN CSS
		$css_files = array(
			css_asset('general.css')
		);
		
		//ADDITIONAL CSS
		if (isset($additional_data['css'])){
			foreach ($additional_data['css'] as $additional_css){
				$css_files[] = css_asset($additional_css);
			}
		}
		
		//MAIN JS
		$js_files = array(
			js_asset('config.js'),
			js_asset('general.js')
		);
		
		//ADDITIONAL JS
		if (isset($additional_data['js'])){
			foreach ($additional_data['js'] as $additional_js){
				$js_files[] = js_asset($additional_js);
			}
		}
		
		$header_data = array(
			'css_files' => $css_files,
			'js_files' => $js_files
		);
		
		$this->load->view('general/header', $header_data);
	}
	
	private function _footer(){
		$this->load->view('general/footer');
	}
	
	//pages
	
	public function index(){
		$this->_header();
		$this->load->view('startpage');
		$this->_footer();
	}
	
	public function sentencer($id = 0){
		
		$this->load->model('sentencer');
		
		if (!$id) $id = $this->sentencer->get_random_sentence();
		
		$sentence = $this->sentencer->load($id);
		
		$pagedata['sentence'] = $sentence->item;
		
		$header_data = array('js'=>array('sentencer.js'));
		$this->_header($header_data);
		
		
		$this->load->view('sentencer-view', $pagedata);
		$this->_footer();
	}
	
	public function sentencer_test(){
		$this->load->model('sentencer');
		$resp = $this->sentencer->check_sentence();
		$this->_header();
		//echo json_encode(array('info'=>$resp));
		echo $resp;
	}
	
	public function verb_uploader(){
		$header_data = array('js'=>array('verb-uploader.js'));
		
		$this->_header($header_data);
		$this->load->view('verb-uploader-view');
		$this->_footer();
	}
	
	public function test(){
		$this->_header();
		$this->load->view('test');
		$this->_footer();
	}
	
	public function word_uploader($id = 0){
		//$header_data = array('js'=>array('word-uploader.js'));
		
		$this->load->model('word');
		
		if($this->input->post()){
			if($this->input->post('id'))
				$this->word->update($this->input->post('id'), $this->input->post('data'), $this->input->post('flags'));
			else
				$this->word->add($this->input->post('data'), $this->input->post('flags'));
		}
		
		$word = $this->word->load($id);
		$pagedata['word'] = $word->item;
		
		$this->_header();
		$this->load->view('word-uploader-view', $pagedata);
		$this->_footer();
	}

	public function word_bulk_uploader($actword = ''){
		//$header_data = array('js'=>array('word-uploader.js'));
		
		$this->load->model('word');
		$pagedata = array();
		
		if($this->input->post()){
			
			//echo print_array($this->input->post());
			
			$refid = ($this->input->post('id'))? $this->input->post('id'):0;
			
			if ($refid) $pagedata['word_updated'] = TRUE;
			else $pagedata['word_added'] = TRUE;
			
			foreach($this->input->post('word') as $word){
				if ($word['data']['word']){
					if ($word['data']['id']){
						$this->word->update($word['data']['id'],$word['data'],$word['flags']);
					}else{
						if ($refid) $word['data']['ref_id'] = $refid;
						$last_id = $this->word->add($word['data'], $word['flags']);
						if (!$refid) {
							$refid = $last_id;
							$actword = $word['data']['word'];
						}
					}
				}
			}
			
		}

		$word = FALSE;
		if ($actword){
			$actid = $this->word->findID($actword);
			if ($actid) $word = $this->word->load($actid);
		}
		
		$pagedata['word'] = $word;
		
		$this->_header();
		$this->load->view('word-bulk-uploader-view', $pagedata);
		$this->_footer();
	}
	
	public function dictionary($word = ''){
		
		$this->load->model('word');
		
		$word = ($this->input->post('word'))? $this->input->post('word'):$word;
		$pagedata['word'] = $word;
		
		if ($word){
			$found = $this->word->find($word);
			$pagedata['found'] = $found;
		}
		
		$this->_header();
		$this->load->view('dictionary', $pagedata);
		$this->_footer();
	}
	
	public function wordwiz(){
		$this->load->model('wordwiz');
		
		$word = $this->input->post('word');
		$old = $this->input->post('old');
		
		$pagedata['word'] = $word;
		$pagedata['old'] = $old;
		
		if ($word){
			$wordwiz = $this->wordwiz->create($word,$old);
			$pagedata['wordwiz'] = $wordwiz;
		}
		
		$this->_header();
		$this->load->view('wordwiz', $pagedata);
		$this->_footer();
	}
		
}