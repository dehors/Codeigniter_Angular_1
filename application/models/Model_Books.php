<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Model_Books extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function Get($id = NULL){
		if (! is_null($id)) {
			$query = $this->db->select("*")->from("books")->where("id",$id)->get();
			if ($query->num_rows() === 1) {
				return $query->row_array(); 
			}
			return NULL;
		}

		$query = $this->db->select("*")->from("books")->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return $query->result();
	}
	public function Save($book){
		$this->db->set(
			$this->_setBook($book)
		)->insert("books");
		if ($this->db->affected_rows() === 1) {
			return $this->db->insert_id();
		}
		return NULL;
	}
	public function Update($id, $book){
		$this->db->set(
			$this->_setBook($book)
		)
		->where('id',$id)
		->update("books");
		if ($this->db->affected_rows() === 1) {
			return TRUE;
		}
		return NULL;
	}
	private function _setBook($book){
		return array('title' => $book['title'],'author' => $book['author'],'snopsis' => $book['snopsis'],'isbn' => $book['isbn']);
	}
	public function Delete($id){
		$this->db->where('id',$id)->delete("books");
		if ($this->db->affected_rows() === 1) {
			return TRUE;
		}
		return NULL;
	}
}