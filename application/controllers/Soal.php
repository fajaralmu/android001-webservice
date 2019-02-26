<?php
header("Access-Control-Allow-Origin: *");
require_once('rest/functions.php');
class Soal extends CI_Controller{
	
	public $api;
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_soal'));
		$this->load->helper(array('url_helper','url','file'));
		//$this->api = new Api;
	}
	
	function index(){
		$judul = 'none';
		echo $judul;
	}

	function update(){
		//$api_dasbor = $this->api->dasbor();
		if(1+1==2)
		{
			/*$soal['id'] = $this->input->post('id');
			$soal['idujian'] = $this->input->post('idujian');
			$soal['nilai'] = $this->input->post('nilai');*/
			$soal=json_decode(file_get_contents('php://input'),1);
			
			if($this->model_soal->update($soal))
				echo true;
			else
				echo false;
		}else
			echo false;
	}

	function soalbyid($id){
		echo json_encode($this->model_soal->dapatkan_soal_id($id));
	}
	
	
	function soalbyidujian($id){
		echo json_encode($this->model_soal->dapatkan_soal_id_ujian($id));
	}
	
	function tambah(){
/**		$soal['idujian'] = $this->input->post('idujian');
		$soal['nilai'] = $this->input->post('nilai');**/
		$soal=json_decode(file_get_contents('php://input'),1);
		echo $this->model_soal->tambah($soal);
	}
	
	function semua(){
		//$api_dasbor = $this->api->dasbor();
		if(1+1==2){
			$all = $this->model_soal->semua_soal();
			
			echo json_encode($all);
		}
	}

	
	function hapus($id){
		echo $this->model_soal->hapus($id);				
		
	}

	
	
	
}