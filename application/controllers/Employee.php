
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends MY_Controller {
    public function index()
    {
        $this->checkuserPermission("employee_home");
        $data["positions"]   = $this->employee_model->getPositionList();
        $data["departments"] = $this->employee_model->getDepartmentList();
        $data["employees"]   = $this->employee_model->getEmployees();
        $this->loadView("employee/employee", $data);
    }

    public function insertEmployee() {
        $result                 = array();
        $result["error"]        = false;
        $result["message"]      = "";
        $user_data              = array();
        $employee_data          = array();
        $employment_info        = array();
        $employment_info_fields = $this->employee_model->getEmployeeInfoFields();
        $user_data_fields       = $this->employee_model->getUserDataFields();

        $data = !empty($_POST["data"]) ? $_POST["data"] : array();

        if(!empty($data)) {
            $data   = array_column($data, "value", "name");
            $result = $this->employee_model->checkRequiredField($data); //check required fields

            if($result["error"] == false) {
                foreach($data as $field => $value) {
                    if(!empty($value) && $result["error"] == false) {
                        $field_name = str_replace("-", "_", $field);

                        $field_error = $this->employee_model->checkInput($field_name, $value); //check inputs if valid

                        if($field_error == true) {
                            $result["error"] = true;
                            $result["message"] = "Invalid input of " . str_replace("-", " ", $field);
                        } else {
                            if(in_array($field_name, $user_data_fields)) {
                                $user_data[$field_name] = $value;
                            } elseif(in_array($field_name, $employment_info_fields)) {
                                $employment_info[$field_name] = $value;
                            } else {
                                $employee_data[$field_name] = $value;
                            }
                        }
                    }
                }
            }

            if($result["error"] == false) {
                $check_user_duplicate = $this->employee_model->checkUserDuplicate($user_data["username"]); //check duplicate user
                $check_emp_duplicate  = $this->employee_model->checkEmpDuplicate($employee_data["last_name"], $employee_data["middle_name"], $employee_data["first_name"]); //check duplicate employee data

                if($check_user_duplicate || $check_emp_duplicate) {
                    $result["error"]   = true;
                    $result["message"] = "Employee/User already exist.";
                } else {
                    $user_id = $this->employee_model->insertUser($user_data); //insert to user

                    if($user_id > 0) {
                        $employee_data["employee_id"] = $user_id;
                        $employee_id                  = $this->employee_model->insertEmployee($employee_data, $user_id); //insert to employee table
                        $employment_info              = $this->employee_model->prepareEmployeeInformation($employment_info, $user_id);
                        if($employee_id > 0) {
                            $emp_info_id = $this->employee_model->insertEmployeeInformation($employment_info); //insert to employment information

                            if(!empty($employment_info)) {
                                if($emp_info_id > 0) {
                                    $result["error"]   = false;
                                    $result["message"] = "Employee Successfully Added.";
                                } else {
                                    $result["error"]   = true;
                                    $result["message"] = "Error occured while inserting data!";
                                }
                            } else {
                                $result["error"]   = false;
                                $result["message"] = "Employee Successfully Added.";
                            }
                        } else {
                            $result["error"]   = true;
                            $result["message"] = "Error occured while inserting data2.";
                        }

                    } else {
                        $result["error"]   = true;
                        $result["message"] = "Error occured while inserting data3.";
                    }
                }
            }
        } else {
            $result["error"]   = true;
            $result["message"] = "Invalid input of Fields.";
        }

        echo json_encode($result);
    }

    public function employeeProfile() {
        $this->checkuserPermission("employee_profile");

        $user_id = (!empty($_POST["employee-id"])) ? $_POST["employee-id"] : 0;
        $data    = array();

        if(!empty($user_id)) {
            $data["employee_id"]      = $user_id;
            $data["employee_details"] = $this->employee_model->getEmployeeDetails($user_id);
            $data["employment_info"]  = $this->employee_model->getEmploymentInfo($user_id);
            $departments              = $this->employee_model->getDepartmentList();
            $positions                = $this->employee_model->getPositionList();
            $data["departments"]      = (!empty($departments)) ? array_column($departments, "department_title", "department_id") : array();
            $data["positions"]        = (!empty($positions)) ? array_column($positions, "position_title", "position_id") : array();
            $this->loadView("employee/employeeProfile", $data);
        } else {
            redirect(base_url() . 'dashboard', 'refresh');
        }
    }

    public function getEmployeeInfo() {
        $result      = array();
        $employee_id = (!empty($_POST["employee_id"])) ? $_POST["employee_id"] : 0;

        if(!empty($employee_id)) {
            $employee_info = $this->employee_model->getEmployeeDetails($employee_id);
            $result        = $this->employee_model->prepareUpdateData($employee_info);
        }

        echo json_encode($result);
    }

    public function updatePassword(){
        $result            = array();
        $result["message"] = "Error occured. Please contact system admin.";
        $result["success"] = false;
        $new_pass          = trim($_POST["new_pass"]);
        $curr_pass         = trim($_POST["curr_pass"]);
        $emp_id            = $_POST["emp_id"];
        if(!empty($new_pass) && !empty($curr_pass)){
            if(strlen($new_pass) >= 6){
                if($new_pass == $curr_pass){
                    $update = $this->employee_model->updatePassword($emp_id,$new_pass);
                    if($update){
                        $result["message"] = "Successfully updated password.";
                        $result["success"] = true;
                    }else{
                        $result["message"] = "Old Password detected.";
                    }
                }else{
                    $result["message"] = "Password does not match.";
                }
            }else{
                $result["message"] = "Password must consists of at least 6 characters.";
            }
        }else{
            $result["message"] = "Please provide password";
        }

        echo json_encode($result);
    }

    public function updateUsername(){
        $result            = array();
        $result["message"] = "Something went wrong. Please contact system admin.";
        $result["success"] = false;
        $username          = $_POST["username"];
        $emp_id            = $_POST["emp_id"];
        if(!empty($username)){
            $check = $this->employee_model->checkUsername($emp_id,$username);
            if(!$check){
                $update = $this->employee_model->updateUsername($emp_id,$username);
                if($update == true){
                    $result["message"] = "Successfully updated username.";
                    $result["success"] = true;
                }else{
                    $result["message"] = "No changes detected";
                }
            }else{
                $result["message"] = "Username is already taken.";
            }
        }else{
            $result["message"] = "Please insert username.";
        }
        echo json_encode($result);
    }

    public function updateStatus(){
        $result            = array();
        $result["message"] = "Error occured. Please contact system admin.";
        $result["success"] = false;
        $emp_id            = $_POST["emp_id"];
        $status            = $_POST["status"];
        if(!empty($emp_id)){
            $status = $status == 'inactive' ? 1 : 0;
            $update = $this->employee_model->updateStatus($emp_id,$status);
            if($update){
                $result["message"] = "Successfully updated status.";
                $result["success"] = true;
            }
        }
        echo json_encode($result);
    }
}
