<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	 
	 class Settings extends MY_Controller {
	 	public function index() {
	 		$data = array();
	 		$this->loadView("settings/add_shift", $data);
	 	}

	 	public function viewShift() {
	 		$this->checkuserPermission("my_shift");
	 		$data = array();
	 		$data["shifts"] = $this->settings_model->getShiftV2();

	 		$this->loadView("settings/add_shift", $data);
	 	}

	 	public function storeShift() {

	 		$this->checkuserPermission("my_shift");

	 		// var data = 'shiftName='+shiftName+'&shiftDetails='+shiftDetails+'&timeIn='+timeIn+'&timeOut='+timeOut+'&breakIn='+breakIn+'&breakOut='+breakOut+'&addShift='+addShift+'';
	 		if(isset($_POST['addShift']))
	 		{
	 			$data = array('shiftName'    => $_POST['shiftName'],
	 					      'shiftDetails' => $_POST['shiftDetails'],
	 					      'timeIn'       => $_POST['timeIn'],
	 					      'timeOut'      => $_POST['timeOut'],
	 					      'breakIn'      => $_POST['breakIn'],
	 					      'breakOut'     => $_POST['breakOut']);

		 		$result = $this->settings_model->insertShift($data);
		 		
		 		if($result == 'success')
		 		{
		 			echo 'success';
		 		}
	 		}	
	 		
	 	}

/*
	 	public function addShift() {
	 		$this->checkuserPermission("my_shift");

	 		$data = array();
	 		$data['error'] = false;
	 		$data = array('shift_name' => trim($this->input->post('shift_name')),
	 					  'shift_details' => trim($this->input->post('shift_details')),
	 					  'time_in' => trim($this->input->post('time_in')),
	 					  'time_out' => trim($this->input->post('time_out')),
	 					  'break_in' => trim($this->input->post('break_in')),
	 					  'break_out' => trim($this->input->post('break_out')));

	 		$add_shift = $this->input->post('add_shift');

	 		if(isset($add_shift))
	 		{
	 			if(empty($data['shift_name']) || empty($data['shift_details']) || empty($data['time_in']) || empty($data['time_out']))
	 			{
	 				echo "<script>alert('Empty field(s) found.')</script>";
	 			}
	 			else
	 			{
	 				$this->settings_model->insertShift($data);
	 			}
	 		}

	 		$this->loadView("settings/add_shift", $data);
	 		
	 	}
*/
	 	public function updateShift()
	 	{
	 		$data = array('shift_name' => $this->input->post('updt_shiftName'),
	 					  'shift_details' => $this->input->post('updt_shiftDetails'),
	 					  'time_in' => $this->input->post('updt_timeIn'),
	 					  'time_out' => $this->input->post('updt_timeOut'),
	 					  'break_in' => $this->input->post('updt_breakIn'),
	 					  'break_out' => $this->input->post('updt_breakOut'));
	 		$updt = $this->input->post('updt_shift');
	 		if(isset($updt))
	 		{
	 				
	 				$this->settings_model->updateShift($data);
	 			
	 		}
	 		$this->loadView("settings/add_shift", $data);
	 	}

	 	public function deleteShift()
	 	{
	 		$this->settings_model->deleteShift();
	 	}

	 	public function applyOvertime() {
	 		$this->checkuserPermission("my_overtime");
	 		$data = array();
	 		$this->loadView("settings/my_shift", $data);
	 	}
	 }
