<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	 
	 class Settings extends MY_Controller {
	 	public function index() {
	 		$data = array();
	 		$this->loadView("settings/my_shift", $data);
	 	}

	 	public function changeShift() {
	 		$this->checkuserPermission("my_shift");
	 		$data = array();
	 	
	 			$data["shift_data"] = $this->settings_model->getCurrentShift();
	 		
	 		$this->loadView("settings/my_shift", $data);
	 	}

	 	public function applyOvertime() {
	 		$this->checkuserPermission("my_overtime");
	 		$data = array();
	 		$this->loadView("settings/my_shift", $data);
	 	}
	 }
