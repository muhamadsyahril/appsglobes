<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');	

class Modelmanifest extends CI_Model {


    function __construct() {
        $this->db->reconnect();
        parent::__construct();
    }

	function saveManifest($data)
	{
		$this->db->insert('tbl_manifest', $data);
		return true;
	}

	
}