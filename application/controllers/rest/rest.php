<?php

require_once('MSG.php');

class rest {
	
	public $request;
	public $serviceName;
	public $parameter;

	public function __construct(){
		if($_SERVER['REQUEST_METHOD']!== 'POST'){
			$this->kirimError(REQUEST_METHOD_INVALID,'Request method tidak valid');
		}
		$file = fopen('php://input','r');
		$this->request = stream_get_contents($file);
		$this->validasiRequest($this->request);
	}

	public function validasiRequest($request){
		if($_SERVER['CONTENT_TYPE']!=='application/json' && explode(';',$_SERVER['CONTENT_TYPE'])[0]!=='multipart/form-data'){
			$this->kirimError(REQUEST_CONTENTTYPE_INVALID, $_SERVER['CONTENT_TYPE'].' Content type tidak valid');
		}
		$data = json_decode($request, true);
		if(!isset($data['nama']) || $data['nama']==''){
			$this->kirimError(API_NAME_REQ, $data['nama'].' Nama API dibutuhkan');
		}
		$this->serviceName = $data['nama'];
		if($this->serviceName =='tokenbaru' && !is_array($data['parameter'])){
			$this->kirimError(API_PARAM_REQ,'Parameter API dibutuhkan');
		}else if($this->serviceName =='tokenbaru'&& is_array($data['parameter'])){
			$this->parameter = $data['parameter'];
		}
	}

	public function prosesApi(){
		$api = new Api;
		$rMethod = new reflectionMethod('API',$this->serviceName);
		if(!method_exists($api, $rMethod)){
			$this->kirimError(API_NOT_EXIST,'API tidak ada');
		}
		$rMethod->invoke($api);
	}

	public function validasiParameter($namafield, $nilai, $tipedata, $dibutuhkan=true){
		if($dibutuhkan && empty($nilai)){
			$this->kirimError(VALIDATE_PARAMETER_REQ, 'Field '.$namafield. ' dibutuhkan');
		}
		switch ($tipedata) {
			case BOOLEAN:
				if(!is_bool($nilai)){
					$this->kirimError(VALIDATE_PARAMETER_DATATYPE,' Tipe data untuk '.$namafield.
					' harusnya boolean');
				}
			break;
			case STRING:
				if(!is_string($nilai)){
					$this->kirimError(VALIDATE_PARAMETER_DATATYPE,' Tipe data untuk '.$namafield.
					' harusnya string');
				}
			break;
			case INTEGER:
				if(!is_numeric($nilai)){
					$this->kirimError(VALIDATE_PARAMETER_DATATYPE,' Tipe data untuk '.$namafield.
					' harusnya angka');
				}
			break;
			default:
				# code...
			break;
			
		}
		return $nilai;
	}

	public function authorizationHeaders(){
		$headers = null;
		if(isset($_SERVER['Authorization'])){
			$headers = trim($_SERVER['Authorization']);
		}else if(isset($_SERVER['HTTP_AUTHORIZATION'])){
			$headers = trim($_SERVER['HTTP_AUTHORIZATION']);
		}else if(function_exists('apache_request_headers')){
			$reqheaders = apache_request_headers();
			$reqheaders = array_combine(array_map('ucwords',array_keys($reqheaders)),
				array_values($reqheaders));
			if(isset($reqheaders['Authorization'])){
				$headers = trim($reqheaders['Authorization']);
			}
		}
		return $headers;
	}

	public function getToken(){
		$headers = $this->authorizationHeaders();
		if(!empty($headers)){
			if(preg_match('/Bearer\s(\S+)/', $headers, $matches)){
				return $matches[1];
			}
		}
		echo $token;
		$this->kirimError(AUTHOR_INVALID,'Autorisasi tidak ditemukan');

	}

	public function kirimError($kode, $pesan){
		header("content-type: application/json");
		$pesanError = json_encode(['error'=>['status'=>$kode, 'pesan'=>$pesan]]);
		echo $pesanError; exit();
	}

	public function kirimRespon($kode, $data){
		header("content-type: application/json");
		$respon = json_encode(['response'=>['status'=>$kode, 'hasil'=>$data]]);
		echo $respon; exit();
	}
	
}