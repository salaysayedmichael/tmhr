<?php
class settings_model extends CI_Model {

	public function __construct()
	{
		// $this->getshifts();
	}
	public function insertShift($data) {
		// var_dump($data); exit;
		try
		{
			
			$data = array(
				'shift_name' => $data['shiftName'],
				'shift_details' => $data['shiftDetails'],
				'time_in' => $data['timeIn'],
				'time_out' => $data['timeOut'],
				'break_in' => $data['breakIn'],
				'break_out' => $data['breakOut']
			);
			$this->db->insert('shifts', $data);

			echo 'success';		             
		}
		catch(Exception $e)
		{
			echo 'Error: '.$e->getMessage();
		}

	}

	public function getShiftV2() {
		$sql = "SELECT * FROM shifts
				WHERE deleted = 0
			   ";

		$result = $this->db->query($sql)->result_array();

		return $result;
	}

	public function getShifts()
	{
		$query = $this->db->query('SELECT shift_name,shift_details,TIME_FORMAT(time_in,"%r") AS                       time_in,TIME_FORMAT(time_out,"%r") AS time_out,TIME_FORMAT(break_in, "%r") AS                        break_in, TIME_FORMAT(break_out, "%r") AS break_out FROM shifts WHERE deleted =                      0');

		foreach ($query->result_array() as $row)
		{
			echo '<tr><td>'.$row['shift_name'].'</td><td id="sd">'.$row['shift_details'].'</td><td>'.$row['time_in'].'     </td><td>'.$row['time_out'].'</td><td>'.$row['break_in'].'</td><td>'.$row['break_out'].'      </td><td><a data-toggle="modal" data-original-title="Update Shift" data-placement="bottom" 		  class="btn btn-primary btn-sm" id="show_updtModal" href="#updt_modal"><i class="fa fa-edit fa-lg"></i></a><a id="dlt_shift" class="btn btn-primary"><i class="fa fa-trash fa-lg" name="dlt_shift"></i></a></td></tr>';
		}
	}

	public function updateShift($data)
	{
		try
		{
			// $sql = $this->db->query('SELECT * FROM users');
			// $row = $sql->row_array();

			$this->db->where('id',1);
			$this->db->update('shifts',$data);
		}
		catch(Exception $e)
		{
			echo 'Error: '.$e->getMessage();
		}
	}

	public function deleteShift()
	{
		if(isset($_POST['dlt_shift']))
		{	
			$this->db->delete('shifts',1);
		}
	}
}