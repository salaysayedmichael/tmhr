<?php
class settings_model extends CI_Model {

	public function getCurrentShift()
	{
		
		$result = array();
		 $sql = "SELECT * 
				 FROM employee_shift";

		 $exe = $this->db->query($sql)->result_array();
		 
		 if(!empty($exe)){
		 	$result = $exe;
		 } 

		 return $result;
	}

	public function getEmpID($empID)
	{
		$result = array();
		$sql = "SELECT employee_id 
				FROM employee";

		$exe = $this->db->query($sql)->result_array();

		if(!empty($exe)){
			$result = $exe;
		}
		return $result;
	}
}