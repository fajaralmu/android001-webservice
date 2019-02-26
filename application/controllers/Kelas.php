<?php
header("Access-Control-Allow-Origin: *");
require_once('rest/functions.php');
class Kelas extends CI_Controller{
	
	public $api;
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_kelas'));
		$this->load->helper(array('url_helper','url','file','directory','form'));
		//$this->api = new Api;
	}
	
	
	function get($id){
		$kelas = $this->model_kelas->dapatkan_kelas_id($id);
			
		echo json_encode($kelas);

	}

	function semua(){
		$all = $this->model_kelas->semua_kelas();
		echo json_encode($all);
	}
	
	
	
	
	
}