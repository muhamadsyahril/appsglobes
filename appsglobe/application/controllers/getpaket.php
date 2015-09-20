<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');	


class getPaket extends CI_Controller{
	
	function __construct() {
		parent::__construct();
	}
	
	function index()
	{
		
					$this->load->model("model_add");
					$response = $this->model_add->ListPaket();
				
					$resp = array();
					foreach ($response as $k=>$v)
					{
						$tmp = array();
						$tmp['id'] = $v['paket_id'];
						$tmp['title'] = $v['nama_paket'];
						$tmp['image'] = 'http://10.0.2.2/appsglobe'.$v['image_path'];
						$tmp['detail'] = $v['diskripsi'];
						$tmp['price']  = 'USD '.$v['harga'];
						array_push($resp, $tmp);
					}

				
					$resp = json_encode($resp);
					echo  $resp ;

					
		

		$this->load->helper('file');
		$params = http_build_query($_REQUEST, NULL, '&');
		$date = date("d-m-Y H:i:s",$_SERVER['REQUEST_TIME']);
		$file = $_SERVER['DOCUMENT_ROOT'].'/appsglobe/logs/'.date("Y-F-d").'.log';
		$logs = "[IP]".$_SERVER['REMOTE_ADDR']."[".$date."] ".$_SERVER['REQUEST_METHOD']." ".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."?".$params."\r\n";
		write_file($file, $logs,"a+");
	

	}

	function all()
	{
		
					$this->load->model("model_add");
					$response = $this->model_add->ListPaket();
				
					$resp = array();
					foreach ($response as $k=>$v)
					{
						$tmp = array();
						$tmp['id'] = $v['paket_id'];
						$tmp['title'] = $v['nama_paket'];
						$tmp['image'] = 'http://10.0.2.2/appsglobe'.$v['image_path'];
						$tmp['detail'] = $v['diskripsi'];
						$tmp['price']  = 'USD '.$v['harga'];
						array_push($resp, $tmp);
					}

				
					$resp = json_encode($resp);
					echo "{\"paket\":" . $resp . "}";

					
		

		$this->load->helper('file');
		$params = http_build_query($_REQUEST, NULL, '&');
		$date = date("d-m-Y H:i:s",$_SERVER['REQUEST_TIME']);
		$file = $_SERVER['DOCUMENT_ROOT'].'/appsglobe/logs/'.date("Y-F-d").'.log';
		$logs = "[IP]".$_SERVER['REMOTE_ADDR']."[".$date."] ".$_SERVER['REQUEST_METHOD']." ".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."?".$params."\r\n";
		write_file($file, $logs,"a+");
	

	}

}