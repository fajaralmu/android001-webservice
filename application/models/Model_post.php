<?php

class Model_post extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		
	} 
	
	function tambah($data){
		if($this->db->insert("post",$data))
			return TRUE;
		else
			return FALSE;
		
	}

	function update($data){
		$this->db->where('id', $data['id']);
		if($this->db->update('post', $data)){
			return true;
		}else{
			return false;
		}
	}
	

	
	function findByIdGuru($id){
		$query = $this->db->get_where('post',array('idguru'=>$id));
		$data = $query->result();
		$query->free_result();
		return $data;
	}



	function dapatkan_post_id($id){
		$query = $this->db->get_where('post',array('id'=>$id));
		$data = $query->row_array();
		$query->free_result();
		return $data;
	}

	function semua_post(){
		$query = $this->db->get('post');
		$data = $query->result();
		$query->free_result();
		return $data;
	}

	function jumlah_post(){
		$this->db->from('post');
		return $this->db->count_all_results();;
	}

	
	function hapus($id){
		if($id==null)
			return FALSE;
		else{
			$this->db->where('id',$id);
			return $this->db->delete('post');
			
		}
	}
	
	
}