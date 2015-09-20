<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');	

class Modelreport extends CI_Model {


    function __construct() {
        $this->db->reconnect();
        parent::__construct();
    }

	function countjemaah()
	{
		$this->db->select("idjemaah");
		$query = $this->db->get("tbl_jemaah");

		return $query->num_rows();

	}

	function countManifest()
	{
		$this->db->select("idjemaah");
		$query = $this->db->get("tbl_manifest");

		return $query->num_rows();

	}

	function getOrder(){

		$this->db->select('*')->select('tbl_jemaah.nama')->from('tbl_jemaah')
			->join('tbl_manifest', 'tbl_manifest.idjemaah=tbl_jemaah.idjemaah')
			->join('tbl_paket', 'tbl_paket.paket_id = tbl_jemaah.idpaket'); 

			$query = $this->db->get();

		 	return $query->result();
		}

	
}