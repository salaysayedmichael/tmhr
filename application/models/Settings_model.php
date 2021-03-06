<?php
class settings_model extends CI_Model {

	public function __construct()
	{

	}
	public function insertShift($data) {
		$data["break_in"]  = $data['break_in']  == '' ? NULL: $data['break_in'];
		$data["break_out"] = $data['break_out'] == '' ? NULL: $data['break_out'];
		// var_dump($data); exit;

			$data = array(
				'shift_name'    => $data['shift_name'],
				'shift_details' => $data['shift_details'],
				'time_in'       => $data['time_in'],
				'time_out'      => $data['time_out'],
				'break_in'      => $data['break_in'],
				'break_out'     => $data['break_out']
			);
			$this->db->insert('shifts', $data);
			return true;
	}

	public function getShiftV2() {
		$sql = "SELECT * FROM shifts
				WHERE deleted = 0
			   ";

		$result = $this->db->query($sql)->result_array();

		return $result;
	}

	public function checkShiftNameDuplication($shift_name,$id)
	{
		$result = False;
			if(!empty($shift_name))
			{
				$sql = "SELECT * 
					    FROM shifts 
						WHERE shift_name = '{$shift_name}' AND sid <> {$id} deleted = 0";
				$exe = $this->db->query($sql)->result_array();
				if($exe)
				{
					$result = True;
				}	
			}	
		return $result;
	}

	public function checkTimeIODuplication($time_in,$time_out,$id)
	{	
		$result = False;
		if(!empty($time_in) && !empty($time_out))
		{
			$sql = "SELECT *
					FROM shifts 
					WHERE time_in = '{$time_in}' 
					AND time_out = '{$time_out}' AND sid <> {$id} AND deleted = 0";
			$exe = $this->db->query($sql)->result_array();
			if(count($exe) > 0)
			{
				$result = True;
			}

		}
		return $result;
	}


	public function getShiftData($id)
	{
		$result = array();

		if(!empty($id))
		{
			$sql = "SELECT * FROM shifts
					WHERE sid = '{$id}'";
			$exe = $this->db->query($sql)->result_array();

			if(!empty($exe))
			{
				$result = $exe;
			}

		}
		return $result;
	}

	public function updtShiftData($data)
	{
		$result = False;
		$data = array(
			          'sid'            => $data['id'],
			          'shift_name'    => $data['shift_name'],
			          'shift_details' => $data['shift_details'],
			          'time_in'       => $data['time_in'],
			          'time_out'      => $data['time_out'],
			          'break_in'      => $data['break_in'],
			          'break_out'     => $data['break_out']
					 );
		if(!empty($data))
		{
			$this->db->where('sid', $data['sid']);

			$result = $this->db->update('shifts', $data);
		}
		return $result;
	}

	public function deleteShift($id){
		$result = false;
		if(!empty($id)){
			$sql      = "UPDATE shifts SET deleted = 1 WHERE sid = ?";
			$exe      = $this->db->query($sql,array($id));
			$affected = $this->db->affected_rows();
			if($affected){
				$result = true;
			}
		}
		return $result;
	}
}
// 	public function updateShift($data)
// 	{
// 		try
// 		{
// 			// $sql = $this->db->query('SELECT * FROM users');
// 			// $row = $sql->row_array();

// 			$this->db->where('id',1);
// 			$this->db->update('shifts',$data);
// 		}
// 		catch(Exception $e)
// 		{
// 			echo 'Error: '.$e->getMessage();
// 		}
// 	}

// 	public function deleteShift()
// 	{
// 		if(isset($_POST['dlt_shift']))
// 		{	
// 			$this->db->delete('shifts',1);
// 		}
// 	}
// }