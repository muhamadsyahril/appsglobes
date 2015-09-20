<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');	

class Jemaah extends CI_Controller 
{
	public $responseSuccess = [ 
	                             'code' => 200,
	                             'message' => 'Success save'
								];

	public $responseUnSuccess = [ 
	                             'code' => 0,
	                             'message' => 'Not success save'
								];



			
	function __construct() {
        parent::__construct();
        $this->load->model('modeljemaah');
    }
	

	public function index(){
		return $this->apiDaftarJemaah();

	}

	public function apiDaftarJemaah(){

			$response = json_encode($this->responseUnSuccess);

			if($post = $this->input->post())
			{
				if(!$post['nama'])
					$response = json_encode($this->responseUnSuccess);

				if(!$post['alamat'])
					$response = json_encode($this->responseUnSuccess);

				if(!$post['tempat_lahir'])
					$response = json_encode($this->responseUnSuccess);

				if(!$post['tgl_lahir'])
					$response = json_encode($this->responseUnSuccess);

				if(!$post['no_telp'])
					$response = json_encode($this->responseUnSuccess);

				if(!$post['email'])
					$response = json_encode($this->responseUnSuccess);

				if(!$post['paket_id'])
					$response = json_encode(array(
											'code' => 007,
											'message' => 'Choose your paket.'	
						                 ));


				$data  = [
							'nama' => $post['nama'],
							'alamat' => $post['alamat'],
							'tempt_lahir' => $post['tempat_lahir'],
							'tgl_lahir' => $post['tgl_lahir'],
							'no_telp' => $post['no_telp'],
							'email' => $post['email'],
							'idpaket' => $post['paket_id']
						]; 

				$this->modeljemaah->saveJemaah($data);
			    $response = json_encode($this->responseSuccess);
	            
			}
		
		
		echo $response;

		$this->load->helper('file');
		$params = http_build_query($_REQUEST, NULL, '&');
		$date = date("d-m-Y H:i:s",$_SERVER['REQUEST_TIME']);
		$file = $_SERVER['DOCUMENT_ROOT'].'/appsglobe/logs/'.date("Y-F-d").'.log';
		$logs = "[IP]".$_SERVER['REMOTE_ADDR']."[".$date."] ".$_SERVER['REQUEST_METHOD']." ".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."?".$params."\r\n";
		write_file($file, $logs,"a+");
		
	}

	public function getAllJemaah(){

					$data = $this->modeljemaah->getAll(); 
					$resp = array();

					foreach ($data as $k=>$v)
					{
						$tmp = array();
						$tmp['id'] = $v->idjemaah;
						$tmp['nama'] = $v->nama;
						array_push($resp, $tmp);
					}

				
					$resp = json_encode($resp);
					echo "{\"jemaah\":" . $resp . "}";

					
		

		$this->load->helper('file');
		$params = http_build_query($_REQUEST, NULL, '&');
		$date = date("d-m-Y H:i:s",$_SERVER['REQUEST_TIME']);
		$file = $_SERVER['DOCUMENT_ROOT'].'/appsglobe/logs/'.date("Y-F-d").'.log';
		$logs = "[IP]".$_SERVER['REMOTE_ADDR']."[".$date."] ".$_SERVER['REQUEST_METHOD']." ".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."?".$params."\r\n";
		write_file($file, $logs,"a+");

	}


} 