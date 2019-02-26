<?php

class Model_kelas extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		
	} 
	
	
	function dapatkan_kelas_id($id){
		$query = $this->db->get_where('kelas',array('id'=>$id));
		$data = $query->row_array();
		$query->free_result();
		return $data;
	}

	
	function semua_kelas(){
		$query = $this->db->get('kelas');
		$data = $query->result();
		$query->free_result();
		return $data;
	}
	
	
}