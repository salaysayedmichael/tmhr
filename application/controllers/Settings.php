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
	 		$result = array();
	 		$result['error'] = True;
	 		$result['message'] = 'Error occured while adding. Please contact system administrator.';
	 		$data = array('shift_name'    => trim($_POST['shiftName']),
	 					      'shift_details' => trim($_POST['shiftDetails']),
	 					      'time_in'       => trim($_POST['timeIn']),
	 					      'time_out'      => trim($_POST['timeOut']),
	 					      'break_in'      => trim($_POST['breakIn']),
	 					      'break_out'     => trim($_POST['breakOut'])
	 					  	  );
	 		if(!empty($data['shift_name']) && !empty($data['time_in']) && !empty($data['time_out']))
	 		{
	 				$check_shift_name = $this->settings_model->checkShiftNameDuplication($data["shift_name"]);

	 				if($check_shift_name == False)
	 				{
	 					$check_time_in_out = $this->settings_model->checkTimeIODuplication($data['time_in'],$data['time_out']);
	 					if($check_time_in_out == False)
	 					{
	 						$store_shift = $this->settings_model->insertShift($data);
		 					if($store_shift){
		 						$result['error'] = False;
		 						$result['message'] = "New Shift added successfully.";
		 					}else{
		 						$result['message'] = "Failed to add new shift.";
		 					}
	 					}
	 					else
	 					{
	 						$result['message'] = 'Time in or out is already added in database!';
	 					}
	 				}
	 				else
	 				{
	 					$result['message'] = "Already have Shift Name: ".$data['shift_name'].'!';
	 				}
	 				
	 		}

	 		echo json_encode($result);
	 			
	 	}
	 

	 	public function getShiftData()
	 	{
	 		$id = $_POST['shift_id'];
	 		$result = $this->settings_model->getShiftData($id);
	 		foreach($result as $key => $data)

	 		echo json_encode($data);
	 	}

	 	public function updtShiftData()
	 	{
	 		$result = array();
	 		$result['error'] = True;
	 		$result['message'] = 'Error occured while updating.Please contact the system administrator';
	 		$data = array(
	 					  'id'            => $_POST['id'],
	 					  'shift_name'    => $_POST['shift_name'],
	 					  'shift_details' => $_POST['shift_details'],
	 					  'time_in'       => $_POST['time_in'],
	 					  'time_out'      => $_POST['time_out'],
	 					  'break_in'      => $_POST['break_in'],
	 					  'break_out'     => $_POST['break_out']
	 					 );
	 		if(!empty($data))
	 		{
	 			$check_shiftname = $this->settings_model->checkShiftNameDuplication($data['shift_name']);
	 			
	 			if($check_shiftname)
	 			{
	 				$result['message'] = 'Shift name '.$data['shift_name'].' is already added.';
	 			}
	 			else
	 			{
	 				$check_timeinout = $this->settings_model->checkTimeIODuplication($data['time_in'],$data['time_out']);
	 				if($check_timeinout)
	 				{
	 					$result['message'] = 'Time in '.$data['time_in'].' or out '.$data['time_out'].' is already added.';
	 				}
	 				else
	 				{
	 					$update = $this->settings_model->updtShiftData($data);
			 			if($update)
			 			{
			 				$result['error'] = False;
			 				$result['message'] = 'Shift update successfully.';
			 			}
			 			else
			 			{
			 				$result['message'] = 'Failed to update.';
			 			}
	 				}
	 			}
	 			
	 		}
	 		else
	 		{
	 			$result['message'] = 'Empty fields found!';
	 		}

	 		echo json_encode($result);
	 	}
	 }
	 // 	public function updateShift()
	 // 	{
	 // 		$data = array('shift_name' => $this->input->post('updt_shiftName'),
	 // 					  'shift_details' => $this->input->post('updt_shiftDetails'),
	 // 					  'time_in' => $this->input->post('updt_timeIn'),
	 // 					  'time_out' => $this->input->post('updt_timeOut'),
	 // 					  'break_in' => $this->input->post('updt_breakIn'),
	 // 					  'break_out' => $this->input->post('updt_breakOut'));
	 // 		$updt = $this->input->post('updt_shift');
	 // 		if(isset($updt))
	 // 		{
	 				
	 // 				$this->settings_model->updateShift($data);
	 			
	 // 		}
	 // 		$this->loadView("settings/add_shift", $data);
	 // 	}

	 // 	public function deleteShift()
	 // 	{
	 // 		$this->settings_model->deleteShift();
	 // 	}

	 // 	public function applyOvertime() {
	 // 		$this->checkuserPermission("my_overtime");
	 // 		$data = array();
	 // 		$this->loadView("settings/my_shift", $data);
	 // 	}
	 // }
