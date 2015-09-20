<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');	

class Report extends CI_Controller 
{

			
	function __construct() {
        parent::__construct();
        $this->load->model('modelreport');
    }
	


	public function getReportPaket(){

			$pendaftaran = $this->modelreport->countjemaah();
			$manifest = $this->modelreport->countManifest();
			$data = $this->modelreport->getOrder();
			$total = array('daftar' =>$pendaftaran, 'order'=>$manifest);

			$resp = array();
					foreach ($data as $k=>$v)
					{
						
						$tmp = array();
						$tmp['jemaah'] = $v->nama;
						$tmp['price'] = $v->harga;
						$tmp['announced'] = date("Y/m", strtotime($v->date_of_issu));
						array_push($resp, $tmp);
					}
					$paket['data'] = $resp;
					$resp = array_merge($total, $paket);
					$resp = json_encode($resp);
					echo  $resp ;

		$this->load->helper('file');
		$params = http_build_query($_REQUEST, NULL, '&');
		$date = date("d-m-Y H:i:s",$_SERVER['REQUEST_TIME']);
		$file = $_SERVER['DOCUMENT_ROOT'].'/appsglobe/logs/'.date("Y-F-d").'.log';
		$logs = "[IP]".$_SERVER['REMOTE_ADDR']."[".$date."] ".$_SERVER['REQUEST_METHOD']." ".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."?".$params."\r\n";
		write_file($file, $logs,"a+");
		
	}
} 