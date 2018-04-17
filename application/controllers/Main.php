<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model');
	}


	public function index()
	{	
		$kategori = $this->Main_model->get_tabel('tb_kategori');
		$id = array();
		$row = array();
		foreach ($kategori as $key)
		{
			$where = array ( 'id_kategori' => $key['id_kategori']);
			$id[] = $key['id_kategori'];
			$row[] = $this->Main_model->get_num_rows('tb_device', $where);
		}

		$devicelist = array_combine($id, $row);

		$data = array(
			'kategori' => $kategori,
			'devicelist' => $devicelist,
			'body' => 'devicelist.php', 
			);
		$this->load->view('layout',$data);
	}

	public function form($form)
	{

		if ($form == 'device') {
			
			$device = $this->Main_model->get_tabel('tb_device');
			$data = array (
				'kategori' => $this->Main_model->get_tabel('tb_kategori'),
				'device' => $device,
				'body' => 'form-device.php'
				);
		} 
		elseif ($form == 'kategori') {
			
			$kategori = $this->Main_model->get_tabel('tb_kategori');
			$data = array (
				'body' => 'form-kategori.php',
				'kategori' => $kategori,
				);
		}
		else {
			header("location:index.php");
		}
		

		$this->load->view('layout', $data);

	}

	public function edit($form, $id) 
	{
		if ($form == 'device') {
			$tabel = 'tb_device';
			$where = array ('id_device' => $id);
		}
		elseif ($form == 'kategori') {
			$tabel = 'tb_kategori';
			$where = array ('id_kategori' => $id);

		}
		$data = $this->Main_model->get_data('*', $tabel, $where);
		echo json_encode($data->row());
	}

	public function get_device()
	{
		$id = $this->input->post('id_kategori');
		$data = array('id_kategori' => $id);
		$list = $this->Main_model->get_data('*', 'tb_device', $data)->result_array();
		$listdevice = '';
		foreach ($list as $device) {
			if ($device['status'] == 0) {
				$class = 'btn btn-success';
			}
			elseif ($device['status'] == 1) {
				$class = 'btn btn-danger';
			}

			$listdevice .= '<div class="form-group">
							  <div class="col-xs-7 col-xs-offset-1"><label class="label-control">'.$device['nama_device'].'</label>
							  </div>
							  <div class="col-xs-4">
							  <button id="button-device" onclick="relay('.$device['id_device'].')" data-id="'.$device['id_device'].'" class ="form-control '.$class.'"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></button>
							  </div>
							</div>';
		}

		echo $listdevice;
	}

	public function form_type()
	{
		$value = $this->input->post('value');
				
		if ($value == 'gpio'){
			$formtype = '<div class="form-group">
						<label class="control-label col-xs-3">GPIO</label>
						<div class="col-xs-9">
						<input type="text" class="form-control" name="gpio">
						</div>
						</div>';
		}
		elseif ($value == 'wifi') {
			$formtype = ' <div class="form-group">
						  <label class="control-label col-xs-3">Ip Address</label>
						  <div class="col-xs-9">
						  <input type="text" class="form-control" name="ip-dev">
							</div>
						  </div>';
		}
		elseif ($value == 'rf') {
			$formtype = '
					  <div class="form-group">
					    <label class="control-label col-xs-3">ON/OFF</label>
					    <div class="col-xs-4">
						  <input type="text" class="form-control" name="oncode" placeholder="ON">
						</div>
						<div class="col-xs-4">
						  <input type="text" class="form-control" name="offcode" placeholder="OFF">
						</div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-xs-3">Pulse</label>
					    <div class="col-xs-9">
						  <input type="text" class="form-control" name="pulse">
						</div>
					  </div>';
		}
		else {
			$formtype = 'Not Available';
		}

		echo $formtype;
	}

}
?>