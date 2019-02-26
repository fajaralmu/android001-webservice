<?php
require_once('functions.php');

class Latihanrest extends CI_Controller{
	
	public $api;
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_pengguna'));
		$this->load->helper(array('url_helper','url','file','directory','form'));
		$this->api = new Api;
	}

	function index(){
		
	}

	function home(){
		if($this->api->validasiparam()){
			$this->api->buattoken();
		}else{
			$this->api->kirimRespon(108, 'Identitas tidak valid');
		}
	}

	function dasbor(){
		$api_dasbor = $this->api->dasbor();
		if($api_dasbor[0]){
			echo 'okeeeeee';

		}else{
			echo 'falseeeeeeee';
		}
		
	}

	function menulain(){
		$api_dasbor = $this->api->dasbor();
		if($api_dasbor[0]){
			echo 'okeeeeee';

		}else{
			echo 'falseeeeeeee';
		}
	}

	private function user_valid($u){
		if(!is_array($u)){
			return false;
		}
		return true;
	}
}