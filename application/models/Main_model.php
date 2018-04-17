<?php

class Main_model extends CI_Model
{
	
	function __construct() {
		parent::__construct();
	}

	public function get_tabel($tabel) {
		$query = $this->db->get($tabel);
		return $query->result_array();

	}

	public function device($kategori) {
		$this->db->select('*');
		$this->db->from('tb_device');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_device.id_kategori');
		$this->db->where('nama_kategori', $kategori);
		$query = $this->db->get();
		return $query->result_array();

	}

	public function get_data($select, $tabel, $where) {
		$this->db->select($select);
		$this->db->from($tabel);
		$this->db->where($where);
		$query = $this->db->get();
		return $query;
	}

	public function get_num_rows($tabel,$where){
		$this->db->where($where);
		$row = $this->db->count_all_results($tabel);
		return $row;
	}
}


?>