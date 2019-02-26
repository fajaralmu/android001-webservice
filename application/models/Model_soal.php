<?php

class Model_soal extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		
	} 
	
	function tambah($data){
		if($this->db->insert("soal",$data))
			return TRUE;
		else
			return FALSE;
		
	}

	function update($data){
		$this->db->where('id', $data['id']);
		if($this->db->update('soal', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	function dapatkan_soal_id($id){
		$query = $this->db->get_where('soal',array('id'=>$id));
		$data = $query->row_array();
		$query->free_result();
		return $data;
	}
	
	function dapatkan_soal_id_ujian($id){
		$query = $this->db->get_where('soal',array('idujian'=>$id));
		$data = $query->result();
		$query->free_result();
		return $data;
	}
	
	

	function semua_soal(){
		$query = $this->db->get('soal');
		$data = $query->result();
		$query->free_result();
		return $data;
	}

	function jumlah_soal(){
		$this->db->from('soal');
		return $this->db->count_all_results();;
	}

	
	function hapus($id){
		if($id==null)
			return FALSE;
		else{
			$this->db->where('id',$id);
			return $this->db->delete('soal');
			
		}
	}
	
	function hapus_by_id_ujian($id){
		if($id==null)
			return FALSE;
		else{
			$this->db->where('idujian',$id);
			return $this->db->delete('soal');
			
		}
	}
	
	
}