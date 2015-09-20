<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_add');
	}


	public function index()
	{
		$data = null;
		$data['listGallery'] = $this->model_add->getAllGallery();
		$this->load->view('gallery', $data);
	}

	public function save(){
		if($this->input->post())
		{
			$image		= $this->input->post('imageGallery');
			$galleryPath = str_replace(base_url(),"",$image);
			$arr		= array('image_path'=>$galleryPath);
			$this->model_add->addGallery($arr);
		}
		
		redirect(base_url('gallery'));
	}

	public function delete(){
		if($this->input->post())
		{
			$id = $this->input->post("id");

			if($id){

				$this->db->delete('tbl_gallery', array('id' => $id));
				echo json_encode($response=array("delete_tumb" => "success", "id" => $id));
			}
			
		}
	}

	public function allGallery()
	{
		$response = $this->model_add->getAllGallery();
		$resp = array();

			foreach ($response as $k=>$v)
			{
				$tmp = array();
				$tmp['id'] = $v->id;
				$tmp['image'] = 'http://10.0.2.2/appsglobe/'.$v->image_path;
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

}