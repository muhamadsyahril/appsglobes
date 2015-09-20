<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');	

class Modelvisa extends CI_Model {


    function __construct() {
        $this->db->reconnect();
        parent::__construct();
    }

	function saveVisa($data)
	{
		$this->db->insert('tbl_visa', $data);
		return true;
	}

	
}