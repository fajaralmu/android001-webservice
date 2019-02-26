<?php
header("Access-Control-Allow-Origin: *");
require_once('rest/functions.php');
class Post extends CI_Controller{
	
	public $api;
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_pengguna','model_post'));
		$this->load->helper(array('url_helper','url','file'));
		//$this->api = new Api;
	}
	
	function index(){
		$data['judul'] = "Post";
		$this->load->view('templates/header',$data);
		$this->load->view('pages/post_dashboard',$data);
		$this->load->view('templates/footer');
	}
	
	function tambah(){
		$data=json_decode(file_get_contents('php://input'),1);
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
		if($this->model_post->update($post))
			echo true;
		else
			echo false;
	}

	function dapatkan($id=''){
		if($id!='' && $id != null){
			$post=  $this->model_post->dapatkan_post($id);
			echo json_encode($post);
		}
	}
	
	function postbyid($id){
		echo json_encode($this->model_post->dapatkan_post_id($id));
	}
	
	function semua(){
		$all = $this->model_post->semua_post();
		echo json_encode($all);
	
	}

	function hapus($id){
		echo $this->model_post->hapus($id);				
		
	}
	
	
}