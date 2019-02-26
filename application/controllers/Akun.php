<?php
header("Access-Control-Allow-Origin: *");
require_once('rest/functions.php');
class Akun extends CI_Controller{
	
	public $api;
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model(array('model_pengguna'));
		$this->load->helper(array('url_helper','url','file','directory','form'));
		//$this->api = new Api;
	}
	
	function index(){
		$data['judul'] = 'Login';
		$data['logged_in'] = false;
		$loginvalid = $this->validateLogin();
		if($loginvalid){
			$data['logged_in'] = true;
		}
		$data['session']['username'] = $this->session->userdata('username');
		$data['session']['password'] = $this->session->userdata('password');
		$this->load->view('templates/header',$data);
		if($loginvalid)
			$this->load->view('pages/post_dashboard',$data);
		else
			$this->load->view('pages/login',$data);
		$this->load->view('templates/footer');
	}
	
	function update(){
		$guru = json_decode(file_get_contents('php://input'),1);
			
		if($this->model_pengguna->update($guru))
			echo true;
		else
			echo false;
	}

	function gurubyusername($username=''){
		if($username!='' && $username != null){
			$user =  $this->model_pengguna->dapatkan_pengguna_username($username);
			echo json_encode($user);
		}
	}
	
	function dasbor(){
		$api_dasbor = $this->api->dasbor();
		if($api_dasbor[0]){
			$user=  $this->model_pengguna->dapatkan_pengguna_id($api_dasbor[1]);
			echo json_encode(array('status'=>true, 'user'=>$user ));
		}else{
			echo json_encode(array('status'=>false));
		}
	}
	
	function masuk(){
		$user=json_decode(file_get_contents('php://input'),1);
		$username = $user['namapengguna'];
		$katasandi = $user['katasandi'];
		$session_data = array(
				'username' => $username,
				'password' => $katasandi

		);
		if($this->model_pengguna->masuk($username, $katasandi))
		{
			$this->session->set_userdata($session_data);
			echo true;
		}else{
			echo false;
		}
		
	}

	function masuk_JWT(){
		if($this->api->validasiparam()){
			$this->api->buattoken();
		}else{
			$this->api->kirimError(IDENTITY_INVALID,'identitas tidak valid');
		}
		// $data = json_decode(file_get_contents('php://input'),1);
		// if($this->model_pengguna->masuk($data['username'], $data['katasandi']))
		// {
		// 	echo true;
		// }else{
		// 	echo false;
		// }
	}

	function get($username){
		$user = $this->model_pengguna->dapatkan_pengguna($username);
		$status = array('user'=>$user);
		if($user!=null)
			$status['ok']=1;
		echo json_encode($status);
	}

	function get_id($id){
		$api_dasbor = $this->api->dasbor();
		$status['ok']=0;
		if($api_dasbor[0])
		{
			$user = $this->model_pengguna->dapatkan_pengguna_id($id);
			$status = array('namauser'=>$user['nama']);
			if($user!=null)
				$status['ok']=1;
		}
		echo json_encode($status);

	}

	function cek(){
		$data = json_decode(file_get_contents('php://input'),1);
		if($this->model_pengguna->masuk($data['username'], $data['katasandi']))
			echo true;
		else
			echo false;
	}

	function validateLogin(){
		$username = $this->session->userdata('username');
		$password= $this->session->userdata('password');
		return 	$this->model_pengguna->masuk($username, $password);
	}

	function keluar(){
		$this->session->sess_destroy();
	}
	
	
	
	
	
}