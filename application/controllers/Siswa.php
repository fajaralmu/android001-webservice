<?php
header("Access-Control-Allow-Origin: *");
require_once('rest/functions.php');
class Siswa extends CI_Controller{
	
	public $api;
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_siswa','model_ujian','model_soal'));
		$this->load->helper(array('url_helper','url','file'));
		//$this->api = new Api;
	}
	
	function index(){
		$judul = 'none';
		echo $judul;
	}
	
	function tambahJSON(){
		$data=json_decode(file_get_contents('php://input'),1);
		if(isset($data['nama']) && isset($data['tgllahir']) && isset($data['kelas'])){
			if($this->model_siswa->tambah($data))
				echo true;
			else
				echo false;
		}else
			echo false;
	
	}

	function update(){
		//$api_dasbor = $this->api->dasbor();
		if(1+1==2)
		{
			$siswa=json_decode(file_get_contents('php://input'),1);
			/*$siswa['id'] = $this->input->post('id');
			$siswa['nama'] = $this->input->post('nama');
			$siswa['kelas'] = $this->input->post('kelas');
			$siswa['lahir'] = $this->input->post('lahir');*/
			
			if($this->model_siswa->update($siswa))
				echo true;
			else
				echo false;
		}else
			echo false;
	}

	function dapatkan($id=''){
		if($id!='' && $id != null){
			$user=  $this->model_siswa->dapatkan_siswa($id);
			echo json_encode($user);
		}
	}
	
	function siswabyid($id){
		echo json_encode($this->model_siswa->dapatkan_siswa_id($id));
	}
	
	function tambah(){
		$siswa=json_decode(file_get_contents('php://input'),1);
	/*	$siswa['nama'] = $this->input->post('nama');
		$siswa['kelas'] = $this->input->post('kelas');
		$siswa['lahir'] = $this->input->post('lahir'); */
		
		echo $this->model_siswa->tambah($siswa);
	}
	
	function semua(){
		//$api_dasbor = $this->api->dasbor();
		if(1+1==2){
			$all = $this->model_siswa->semua_siswa();
			
			echo json_encode($all);
		}
	}

	function dasbor(){
		$api_dasbor = $this->api->dasbor();
		if($api_dasbor[0]){
			$user=  $this->model_siswa->dapatkan_siswa_id($api_dasbor[1]);
			echo json_encode(array('status'=>true, 'user'=>$user ));
		}else{
			echo json_encode(array('status'=>false));
		}
	}

	
	function hapus($id){
		echo $this->model_siswa->hapus($id);				
		
	}
	
	function hapus_siswa_full($id){
		$ujian = $this->model_ujian->dapatkan_ujian_id_siswa($id);
		if($this->model_siswa->hapus($id) && 
			$this->model_ujian->hapus($ujian['id'])
				&& $this->model_soal->hapus_by_id_ujian($ujian['id'])){
				echo true;
		}else
				echo false;
		
	}

	
	
	
}