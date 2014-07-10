<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reader extends CI_Model {
	
	var $id;
	var $item;
	
	function __construct() {
		parent::__construct();
	}
	
	function get_book($book_id, $chapter, $page){
		
		$this->id = $book_id;
		
		//check for the book
		$book_fi_file = 'content/books/'.$book_id.'/FI/'.$chapter.'_ch.html';
		$book_en_file = 'content/books/'.$book_id.'/EN/'.$chapter.'_ch.html';
		if(is_file($book_fi_file) && is_file($book_en_file)){
			
			$book_fi = file_get_contents($book_fi_file);
			$book_en = file_get_contents($book_en_file);
			
			
			$this->item->book_fi->content = $book_fi;
			$this->item->book_en->content = $book_en;
		}
		
		return $this->item;
		
	}
}
