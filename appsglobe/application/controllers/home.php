<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_add');
	}


	public function index()
	{
		$data['listpaket'] = $this->model_add->ListPaket();
		$this->load->view('home', $data);
	}


	public function save(){
		

		if($this->input->post())
		{
			
			$nama		= $this->input->post('paketname');
			$diskripsi	= $this->input->post('diskripsi');
			$image		= $this->input->post('imagepaket');
			$harga		= $this->input->post('harga');
			$paketimageurl = str_replace(BASE_URL,"",$image);
			$arr		= array('paketname'=>$nama,'diskripsi'=>$diskripsi,'imagepaket'=>$paketimageurl,'harga'=>$harga);
			$this->model_add->insertPaket($arr);
		}
		
		redirect(base_url());
	}

	public function delete($id){
		

		if($id == null){
			redirect(base_url());
		}
		
		if(!$this->model_add->findPaketById($id)){
				redirect(base_url());
		}

		$this->model_add->deletePaketById($id);

		redirect(base_url());

	}

}