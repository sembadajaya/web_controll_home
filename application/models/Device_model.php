<?php
/**
* 
*/
class Device_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function add($tabel, $data) {
		$this->db->insert($tabel, $data);
		return TRUE;
	}

	public function delete($tabel, $data) {
		$this->db->delete($tabel, $data);
	}

	public function update($tabel, $data, $where) {
		$this->db->update($tabel, $data, $where);
		return TRUE;
	}
}

?>