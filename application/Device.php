<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Device extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Device_model');
		$this->load->model('Main_model');
	}

	public function add()
	{
		//check where form
		$form = $this->input->post('form');
		$type = $this->input->post('typeDevice');
		if ($form == 'device') {
			//data for device
			if ( $type == 'gpio') {
				$data2 = array ( 'gpio' => $this->input->post('gpio') );
			}
			elseif ( $type == 'wifi') {
				$data2 = array ( 'ip_device' => $this->input->post('ip-dev') );
			}
			elseif ( $type == 'rf') {
				$data2 = array ( 
							'onrf_code' => $this->input->post('oncode'),
							'offrf_code' => $this->input->post('offcode'),
							'pulserf' => $this->input->post('pulse')
						);
			}

			$data1 = array (
				'id_device' => '',
				'nama_device' => $this->input->post('nama_device'),
				'type_device' => $this->input->post('typeDevice'),
				'id_kategori' => $this->input->post('kategori'),
				'status' => 0
				);

			$data = array_merge($data1, $data2);
			$tabel = 'tb_device';
		}
		elseif ($form == 'kategori') {
			//data for kategori
			$data = array (
				'id_kategori' => '',
				'nama_kategori' => $this->input->post('nama_kategori')
				);
			$tabel = 'tb_kategori';
		}

		$this->Device_model->add($tabel, $data);
		echo json_encode(array("status" => TRUE));
	}

	public function update()
	{
		$form = $this->input->post('form');

		if ($form == 'device') {
			$tabel = 'tb_device';
			$type = $this->input->post('typeDevice');

			$data1 = array (
				'nama_device' => $this->input->post('nama_device'),
				'id_kategori' => $this->input->post('kategori'),
				);

			if ( $type == 'gpio') {
				$data2 = array ( 'gpio' => $this->input->post('gpio') );
			}
			elseif ( $type == 'wifi') {
				$data2 = array ( 'ip_device' => $this->input->post('ip-dev') );
			}
			elseif ( $type == 'rf') {
				$data2 = array ( 
							'onrf_code' => $this->input->post('oncode'),
							'offrf_code' => $this->input->post('offcode'),
							'pulserf' => $this->input->post('pulse')
						);
			}

			$where = array (
				'id_device' => $this->input->post('id_device')
				);
			$data = array_merge($data1, $data2);
		}
		elseif ($form == 'kategori') {
			$tabel = 'tb_kategori';
			$data = array (
				'nama_kategori' => $this->input->post('value')
				);
			$where = array (
				'id_kategori' => $this->input->post('id')
				);
		}

		$this->Device_model->update($tabel, $data, $where);
		echo json_encode(array("status" => TRUE));
	}

	public function delete($tabel, $data)
	{
		if ($tabel == 'device') {
			$tabel = 'tb_device';
			$where = array ('id_device' => $data);
		}
		elseif ($tabel == 'kategori') {
			$tabel = 'tb_kategori';
			$where = array ('id_kategori' => $data);
		}

		$this->Device_model->delete($tabel, $where);
		echo json_encode(array("status" => TRUE));
	}

	public function onoff()
	{
		$id = $this->input->post('id');

		$where = array ('id_device' => $id );
		$datadevice = $this->Main_model->get_data('*', 'tb_device', $where)->result_array();
		foreach ($datadevice as $device) {
			$id_device = $device['id_device'];
			$status = $device['status'];
			$type = $device['type_device'];
			$gpio = $device['gpio'];
			$wifi = $device['ip_device'];
			$onrf = $device['onrf_code'];
			$offrf = $device['offrf_code'];
			$pulse = $device['pulserf'];
		}

		if ($type == 'gpio') {
			if( $status == 0){
				system('sudo python /var/www/html/smartroom/asset/py/gpio'.$gpio.'on.py');
				$data = array('status' => '1' );
				$where = array('id_device' => $id_device);
			}
			elseif ($status == 1) {
				system('sudo python /var/www/html/smartroom/asset/py/gpio'.$gpio.'off.py');
				$data = array('status' => '0' );
				$where = array('id_device' => $id_device);
			}
		}
		elseif ($type == 'wifi') {
			# code...
		}
		elseif ($type == 'rf') {
			$codeSendPath = './var/www/html/smartroom/asset/rfoultet/codesend';
			$codeSendPIN = "0";
			$codeSendPulseLength = $pulse;

			if( $status == 0){
				$codeSendCode = $onrf;
				system('sudo'.$codeSendPath.' '.$codeSendCode.' -p '.$codeSendPIN.' -l '.$codeSendPulseLength);
				$data = array('status' => '1' );
				$where = array('id_device' => $id_device);
			}
			elseif ($status == 1) {
				$codeSendCode = $offrf;
				system('sudo'.$codeSendPath.' '.$codeSendCode.' -p '.$codeSendPIN.' -l '.$codeSendPulseLength);
				$data = array('status' => '0' );
				$where = array('id_device' => $id_device);
			}
		}
		
		$this->Device_model->update('tb_device', $data, $where);
		echo json_encode(array("status" => TRUE));
		
	}
}

?>