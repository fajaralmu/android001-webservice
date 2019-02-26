<?php

class Model_pengguna extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		
	} 
	
	
	function update($data){
		$this->db->where('id', $data['id']);
		if($this->db->update('guru', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	function masuk($username, $katasandi){
		$where_array = array('namapengguna'=>$username, 'katasandi'=>$katasandi);
		$query = $this->db->get_where('guru',$where_array);
		$hasil = $query->num_rows();
		$query->free_result();
		if($hasil==1){
			return true;
		}else
			return false;
			
	}

	

	
	function dapatkan_pengguna_username($username){
		$query = $this->db->get_where('guru',array('namapengguna'=>$username));
		$data = $query->row_array();
		$query->free_result();
		return $data;
	}

	
	function hapus($id){
		if($id==null)
			return FALSE;
		else{
			$this->db->where('id',$id);
			return $this->db->delete('user');
			
		}
	}
	
	
}