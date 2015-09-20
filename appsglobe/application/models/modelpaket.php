<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');	

class Modelpaket extends CI_Model {


    function __construct() {
        // Call the Model constructor
        $this->db->reconnect();
        parent::__construct();
    }

	function saveJemaah($data)
	{
		$this->db->insert('tbl_jemaah', $data);
		return true;
	}
}