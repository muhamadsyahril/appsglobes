<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');	


class Api_login extends CI_Controller{
	
	public function __construct() {
		parent::__construct();
	}
	
	function index()
	{
		
		
   		if (isset($_POST['tag']) && $_POST['tag'] != '') {

			$tag = $_POST['tag'];
			$response = array("tag" => $tag, "success" => 0, "error" => 0);

				if ($tag == 'login') {

					$username = $_POST['username'];
					$password = $_POST['password'];

					$this->load->model("cmsadmin");
					$user = $this->cmsadmin->getUserByEmailAndPassword($username, $password);
		
						if (count($user) == 1) {
			
							$response["success"] = 1; 
							$response["user"]["uid"] = $user[0]["nomerid_pel_pet"];
							$response["user"]["name"] = $user[0]["username"];
							$response["user"]["menu"] = $user[0]["level"];
							$response["user"]["created_at"] = date("Y-m-d H:i:s");
							
			
							$resp = json_encode($response);
							echo $resp;	
			
							} else {

								$response["error"] = 1;
								$response["error_msg"] = "Incorrect email or password!";
								$resp = json_encode($response);
								echo $resp;
						}
				} elseif($tag == 'getPaket') {

					$this->load->model("model_add");
					$response = $this->model_add->ListPaket();
					
					foreach ($response as $k=>$v)
					{
						$response[$k]['image_path'] = BASE_URL.$v['image_path'];
					}

					echo "<pre>";
						print_r($response);
					echo "</pre>";

					$resp = json_encode($response);
					echo "{\"paket\":" . $resp . "}";

					
				} else {
					echo "Invalid Request";
			}
		} else {
			echo "Access Denied";
		}

		$this->load->helper('file');
		$params = http_build_query($_REQUEST, NULL, '&');
		$date = date("d-m-Y H:i:s",$_SERVER['REQUEST_TIME']);
		$file = $_SERVER['DOCUMENT_ROOT'].'/appsglobe/logs/'.date("Y-F-d").'.log';
		$logs = "[IP]".$_SERVER['REMOTE_ADDR']."[".$date."] ".$_SERVER['REQUEST_METHOD']." ".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."?".$params."\r\n";
		write_file($file, $logs,"a+");

	}
	

}