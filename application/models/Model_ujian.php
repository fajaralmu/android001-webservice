<?php

class Model_ujian extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		
	} 
	
	function tambah($data){
		if($this->db->insert("ujian",$data))
			return TRUE;
		else
			return FALSE;
		
	}

	function update($data){
		$this->db->where('id', $data['id']);
		if($this->db->update('ujian', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	function dapatkan_ujian_id($id){
		$query = $this->db->get_where('ujian',array('id'=>$id));
		$data = $query->row_array();
		$query->free_result();
		return $data;
	}
	
	function dapatkan_ujian_id_siswa($id){
		$query = $this->db->get_where('ujian',array('idsiswa'=>$id));
		$data = $query->row_array();
		$query->free_result();
		return $data;
	}

	function semua_ujian(){
		$query = $this->db->get('ujian');
		$data = $query->result();
		$query->free_result();
		return $data;
	}

	function jumlah_ujian(){
		$this->db->from('ujian');
		return $this->db->count_all_results();;
	}

	
	function hapus($id){
		if($id==null)
			return FALSE;
		else{
			$this->db->where('id',$id);
			return $this->db->delete('ujian');
			
		}
	}
	
	
}