<?php

class Model_siswa extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		
	} 
	
	function tambah($data){
		if($this->db->insert("siswa",$data))
			return TRUE;
		else
			return FALSE;
		
	}

	function update($data){
		$this->db->where('id', $data['id']);
		if($this->db->update('siswa', $data)){
			return true;
		}else{
			return false;
		}
	}
	

	
	function dapatkan_siswa($siswaname){
		$query = $this->db->get_where('siswa',array('nama'=>$siswaname));
		$data = $query->row_array();
		$query->free_result();
		return $data;
	}

	function dapatkan_siswa_id($id){
		$query = $this->db->get_where('siswa',array('id'=>$id));
		$data = $query->row_array();
		$query->free_result();
		return $data;
	}

	function semua_siswa(){
		$query = $this->db->get('siswa');
		$data = $query->result();
		$query->free_result();
		return $data;
	}

	function jumlah_siswa(){
		$this->db->from('siswa');
		return $this->db->count_all_results();;
	}

	
	function hapus($id){
		if($id==null)
			return FALSE;
		else{
			$this->db->where('id',$id);
			return $this->db->delete('siswa');
			
		}
	}
	
	
}