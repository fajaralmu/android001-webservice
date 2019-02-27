<?php
header("Access-Control-Allow-Origin: *");
require_once('rest/functions.php');
class Post extends CI_Controller{
	
	public $api;
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model(array('model_pengguna','model_post'));
		$this->load->helper(array('url_helper','url','file'));
		//$this->api = new Api;
	}
	
	function index(){
		$data['logged_in'] = false;
		$loginvalid = $this->validateLogin();
		if(!$loginvalid){
			redirect('/akun', 'refresh');
		}else{
			$data['logged_in'] = true;
			$data['session']['username'] = $this->session->userdata('username');
			$data['session']['password'] = $this->session->userdata('password');
			$data['judul'] = "Post";
			$data['list_post'] = $this->model_post->findByIdGuru($this->session->userdata('id'));
			
			$this->load->view('templates/header',$data);
			$this->load->view('pages/post_dashboard',$data);
			$this->load->view('templates/footer');
		}
	}
	
	function get(){
		$data=json_decode(file_get_contents('php://input'),1);
		$id = $data['id'];
		$post = $this->model_post->dapatkan_post_id($id);
		if($post['idguru'] == $this->session->userdata('id')){
			echo json_encode($post);
		}else{
			echo null;
		}
	}

	function tambah(){
		$data=json_decode(file_get_contents('php://input'),1);
		$data['idguru'] = $this->session->userdata('id');
		if(isset($data['idguru']) && isset($data['judul']) && isset($data['konten'])){
			if($this->model_post->tambah($data))
				echo true;
			else
				echo false;
		}else
			echo false;
	
	}

	function update(){
		$post=json_decode(file_get_contents('php://input'),1);
		if($this->session->userdata('id') == $post['idguru']){
			if($this->model_post->update($post))
				echo true;
			else
				echo false;
		}else{
			echo false;
		}
	}

	function semua(){
		$all = $this->model_post->semua_post();
		echo json_encode($all);
	
	}

	function validateLogin(){
		$username = $this->session->userdata('username');
		$password= $this->session->userdata('password');
		return 	$this->model_pengguna->masuk($username, $password);
	}

	function hapus(){
		$data=json_decode(file_get_contents('php://input'),1);
		$id = $data['id'];
		echo $this->model_post->hapus($id);				
		
	}
	
	
}