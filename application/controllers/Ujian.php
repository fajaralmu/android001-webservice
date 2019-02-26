<?php
header("Access-Control-Allow-Origin: *");
require_once('rest/functions.php');
class Ujian extends CI_Controller{
	
	public $api;
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_ujian'));
		$this->load->helper(array('url_helper','url','file'));
		//$this->api = new Api;
	}
	
	function testJSON(){
		$data=json_decode(file_get_contents('php://input'),1);
		echo json_encode($data);
	}
	
	function index(){
		$judul = 'none';
		echo $judul;
	}
	
	function tambahJSON(){
		$data=json_decode(file_get_contents('php://input'),1);
		if($this->model_ujian->tambah($data))
			echo true;
		else
			echo false;
		
	
	}

	function update(){
		//$api_dasbor = $this->api->dasbor();
		if(1+1==2)
		{
			$ujian=json_decode(file_get_contents('php://input'),1);
			/**
			$ujian['id'] = $this->input->post('id');
			$ujian['idsiswa'] = $this->input->post('idsiswa');
			$ujian['idguru'] = $this->input->post('idguru');
			$ujian['tajwid'] = $this->input->post('tajwid');
			$ujian['hafalan'] = $this->input->post('hafalan');
			$ujian['kehadiran'] = $this->input->post('kehadiran');
			$ujian['keterangan'] = $this->input->post('keterangan');
			$ujian['total'] = $this->input->post('total');**/
			
			if($this->model_ujian->update($ujian))
				echo true;
			else
				echo false;
		}else
			echo false;
	}

	
	function ujianbyidsiswa($id){
		$ujian=  $this->model_ujian->dapatkan_ujian_id_siswa($id);
		echo json_encode($ujian);
		
	}
	
	function ujianbyid($id){
		echo json_encode($this->model_ujian->dapatkan_ujian_id($id));
	}
	
	function tambah(){
		$ujian=json_decode(file_get_contents('php://input'),1);
		/**$ujian['id'] = $this->input->post('id');
		$ujian['idsiswa'] = $this->input->post('idsiswa');
		$ujian['idguru'] = $this->input->post('idguru');
		$ujian['tajwid'] = $this->input->post('tajwid');
		$ujian['hafalan'] = $this->input->post('hafalan');
		$ujian['kehadiran'] = $this->input->post('kehadiran');
		$ujian['keterangan'] = $this->input->post('keterangan');
		$ujian['total'] = $this->input->post('total');**/
					
		echo $this->model_ujian->tambah($ujian);
	}
	
	function semua(){
		//$api_dasbor = $this->api->dasbor();
		if(1+1==2){
			$all = $this->model_ujian->semua_ujian();
			
			echo json_encode($all);
		}
	}

	
	function hapus($id){
		echo $this->model_ujian->hapus($id);				
		
	}

	
	
	
}