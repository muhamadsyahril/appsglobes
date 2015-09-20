<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_add extends CI_Model {

	function executeData($sql){
		$query	= $this->db->query($sql);
		$rs		= $query->result_array(); 
		return $rs;	
		
	}


	function insertPaket($arr)
	{
		$sql   = "INSERT INTO tbl_paket (nama_paket, diskripsi, image_path, harga, create_date)
				  VALUES('".$arr['paketname']."','".$arr['diskripsi']."','".$arr['imagepaket']."','".$arr['harga']."',now())";	
	    $query = $this->db->query($sql);
		return $query;

	}

	function ListPaket()
	{
		$sql   = "SELECT * FROM tbl_paket";	
	    $query	= $this->executeData($sql);
		return $query;	

	}


	function findPaketById($id){

		$this->db->select('*');
		$this->db->from('tbl_paket');
		$this->db->where('paket_id', $id);

		$query = $this->db->get()->num_rows();

		return $query;
	}

	function deletePaketById($id){

		$this->db->delete('tbl_paket', array('paket_id' => $id));

		return;

	}

	function addGallery($data){

		$this->db->insert('tbl_gallery', $data); 

		return;

	}

	function getAllGallery(){

		$query = $this->db->get("tbl_gallery")->result(); 

		return $query;

	}


}

 



