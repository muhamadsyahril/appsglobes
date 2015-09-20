<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');	

class Manifest extends CI_Controller 
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
        $this->load->model('modelmanifest');
    }
	

	public function index(){
		return $this->apiManifest();

	}

	public function apiManifest(){

			$response = json_encode($this->responseUnSuccess);

			if($post = $this->input->post())
			{
				if(!$post['idjemaah'])
					$response = json_encode($this->responseUnSuccess);

				if(!$post['no_pasport'])
					$response = json_encode($this->responseUnSuccess);

				if(!$post['date_of_issue'])
					$response = json_encode($this->responseUnSuccess);

				if(!$post['iss_cabang'])
					$response = json_encode($this->responseUnSuccess);

			
				if($post['iss_cabang'] && $post['date_of_issue'] && $post['no_pasport'] && $post['idjemaah']){

					$data  = [
							'idjemaah' => $post['idjemaah'],
							'no_psp' => $post['no_pasport'],
							'date_of_issu' => $post['date_of_issue'],
							'iss_cabang' => $post['iss_cabang']
						]; 

					$this->modelmanifest->saveManifest($data);
			   		$response = json_encode($this->responseSuccess);

				}
				
	            
			}
		
		
		echo $response;

		$this->load->helper('file');
		$params = http_build_query($_REQUEST, NULL, '&');
		$date = date("d-m-Y H:i:s",$_SERVER['REQUEST_TIME']);
		$file = $_SERVER['DOCUMENT_ROOT'].'/appsglobe/logs/'.date("Y-F-d").'.log';
		$logs = "[IP]".$_SERVER['REMOTE_ADDR']."[".$date."] ".$_SERVER['REQUEST_METHOD']." ".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."?".$params."\r\n";
		write_file($file, $logs,"a+");
		
	}
} 