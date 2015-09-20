<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');	

class Visa extends CI_Controller 
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
        $this->load->model('modelvisa');
    }
	

	public function index(){
		return $this->apiVisa();

	}

	public function apiVisa(){

			$response = json_encode($this->responseUnSuccess);

			if($post = $this->input->post())
			{

				if(!$post['idjemaah'])
					$response = json_encode($this->responseUnSuccess);


				if(!$post['no_visa'])
					$response = json_encode($this->responseUnSuccess);

				if(!$post['place_issu'])
					$response = json_encode($this->responseUnSuccess);

				if(!$post['date'])
					$response = json_encode($this->responseUnSuccess);


			
				if($post['idjemaah'] && $post['no_visa'] && $post['place_issu'] && $post['date']){

					$data  = [
							'idjemaah' => $post['idjemaah'],
							'no_visa' => $post['no_visa'],
							'place_issu' => $post['place_issu'],
							'date' => $post['date']
						]; 

					$this->modelvisa->saveVisa($data);
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