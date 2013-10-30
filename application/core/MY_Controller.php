<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//AJAX Controller
class Ajax_Controller extends CI_Controller {
	
	var $json_data = Array (
		'error' => 1,
	);
	
	function __construct() {
		parent::__construct ();
		
		$this->output->set_header ( 'Last-Modified: ' . gmdate ( 'D, d M Y H:i:s', time () ) . ' GMT' );
		$this->output->set_header ( 'Expires: ' . gmdate ( 'D, d M Y H:i:s', time () ) . ' GMT' );
		$this->output->set_header ( "Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0" );
		$this->output->set_header ( "Pragma: no-cache" );
		
		//if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
	}
	
	function _output($output) {
		if ($this->json_data['error'] && !isset($this->json_data['error_message'])){
			$this->json_data['error_message'] = 'Invalid Request';
		}
		
		echo json_encode ( $this->json_data );
	}

}