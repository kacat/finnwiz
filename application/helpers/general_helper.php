<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

//formats an array/object to be displayed on screen for debug
if(! function_exists('print_array')){
	function print_array($obj){
		if (ENVIRONMENT == 'production') return FALSE;
		
		$str = '<pre>';
		$str .= print_r($obj, true);
		$str .='</pre>';
		return $str;
	}
}

if(! function_exists('clean_string')){
	function clean_string($str){
		
		$str = str_replace('"', '´', $str);
		return $str;
		
	}
}

?>