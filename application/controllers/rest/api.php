<?php

require_once(APPPATH.'/controllers/rest/jwt.php');
require_once(APPPATH.'/controllers/rest/cekuser.php');

class Api extends rest {
	public $user;
	public $cekuser;
	
	public function __construct(){
		parent::__construct();
		$this->cekuser = new Cekuser;
	}
	
	public function validasiparam(){
		$username = $this->validasiParameter('username', $this->parameter['username'],STRING);
		$katasandi = $this->validasiParameter('katasandi', $this->parameter['katasandi'],STRING);
		if($this->cekuser->user_valid($username, $katasandi)){
			$this->user = $this->cekuser->get_user('user',array('username'=>$username));
			return true;
		}
		return false;
	}

	public function dasbor(){
		$token = $this->getToken();
		if($token=='null'){
			return [false];
		}
		$payload = JWT::decode($token, KATA_SANDI, ['HS256']);
		if($this->cekuser->user_valid($payload->username, $payload->katasandi)){
			return [true,$payload->iduser, $payload];
		}
		return [false];
	}

	public function buattoken(){
		$payload = [
			'iat' =>time(),
			'iss' => 'localhost',
			'exp'=>time()+(15*60),
			'iduser'=>$this->user['id'],
			'username'=>$this->user['username'],
			'katasandi'=>$this->user['katasandi']
		];
		$token = JWT::encode($payload, KATA_SANDI);
		$data = [
			'token'=>$token
		];
		$this->kirimRespon(SUKSES,$data);
	}

	public function setUser($u){
		$this->user = $u;
	}

	public function getparams(){
		return $this->parameter;
	}
	
}