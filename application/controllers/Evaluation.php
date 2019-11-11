
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation extends MY_Controller {
    public function index() {
        $this->checkuserPermission("evaluation_home");

        $group                        = (!empty($_POST["filter-group"])) ? $_POST["filter-group"] : '';
        $filter_id                    = (!empty($_POST["sel-filter-user"])) ? $_POST["sel-filter-user"] : '';
        $filter_status                = (!empty($_POST["sel-filter-status"])) ? $_POST["sel-filter-status"] : 'All';
        
        $data["heads"]                = $this->evaluation_model->getEmployeeManagers();
        $data["evaluations"]          = $this->evaluation_model->getEvaluations($group, $filter_id, $filter_status);
        
        $data["departments"]          = $this->employee_model->getDepartmentList();
        $temp_data                    = $this->evaluation_model->getEvaluationList($group, $filter_id, $filter_status);
        
        $data["evaluation_list"]      = (!empty($temp_data["data"])) ? $temp_data["data"] : array();
        $data["employee_names"]       = $this->evaluation_model->getAllEmployeeNames();
        $data["department_id"]        = array_column($data["departments"], "department_title", "department_id");
        $data["evaluation_attribute"] = $this->evaluation_model->getEvaluationAttribute();
        $data["sel_group"]            = $group;
        $data["filter_id"]            = $filter_id;
        $data["filter_status"]        = $filter_status;

        $this->loadView("evaluation/evaluation", $data);
    }

    public function getCreateEvaluationData() {
        $result     = array();
        $department = (!empty($_POST["department"])) ? $_POST["department"] : 0;

        if(!empty($department)) {
            $result["employee_list"] = $this->evaluation_model->getEmployeeByDepartmentHead($department);
        }

        echo json_encode($result);
    }

    public function createEvaluation() {
        $result            = array();
        $result["error"]   = false;
        $result["message"] = "";

        $dep_head          = (!empty($_POST["dep_head"])) ? $_POST["dep_head"] : 0;
        $dep_emp           = (!empty($_POST["dep_emp"])) ? $_POST["dep_emp"] : array();
        $department        = (!empty($_POST["department"])) ? $_POST["department"] : 0;
        $expiry_date       = (!empty($_POST["expiry_date"])) ? (date("Y-m-d", strtotime($_POST["expiry_date"]))) : null;
        $evaluation_type   = (!empty($_POST["evaluation_type"])) ? $_POST["evaluation_type"] : array();
        $type              = (!empty($_POST["type"])) ? $_POST["type"] : null;

        if(!empty($dep_head) && !empty($dep_emp) && !empty($department) && !empty($evaluation_type)) {
            if($evaluation_type == "Department Head To Employee") {
                $evaluation_data = $this->prepareEmployeeEvaluation($dep_head, $dep_emp, $department, $expiry_date, $evaluation_type, $type);
            } else {
                $evaluation_data = $this->prepareDepHeadEvaluation($dep_head, $dep_emp, $department, $expiry_date, $evaluation_type, $type);
            }

            $evaluation_id = $this->evaluation_model->insertEvaluationData($evaluation_data);

            if($evaluation_id > 0) {
                $result["message"] = "Evaluation Successfully Created.";
            } else {
                $result["error"]   = true;
                $result["message"] = "Error occured while create an evaluation. Please contact system admin.";
            }

        } else {
            $result["error"]   = true;
            $result["message"] = "Error occured while create an evaluation. Please contact system admin.";
        }

        echo json_encode($result);
    }

    private function prepareEmployeeEvaluation($dep_head, $dep_emp, $department, $expiry_date, $evaluation_type, $type) {
        $result  = array();
        $counter = 0;

        if(!empty($dep_emp)) {
            foreach($dep_emp as $emp_key => $emp_id) {
                $result[$counter]["department"]      = $department;
                $result[$counter]["evaluator"]       = $dep_head;
                $result[$counter]["evaluated"]       = $emp_id;
                $result[$counter]["expiry_date"]     = $expiry_date;
                $result[$counter]["evaluation_type"] = $evaluation_type;
                $result[$counter]["type"]            = strtolower($type);

                $counter++;
            }
        }

        return $result;
    }

    private function prepareDepHeadEvaluation($dep_head, $dep_emp, $department, $expiry_date, $evaluation_type, $type) {
        $result  = array();
        $counter = 0;

        foreach($dep_head as $head_key => $head_id) {
            foreach($dep_emp as $emp_key => $emp_id) {
                $result[$counter]["department"]      = $department;
                $result[$counter]["evaluator"]       = $emp_id;
                $result[$counter]["evaluated"]       = $head_id;
                $result[$counter]["expiry_date"]     = $expiry_date;
                $result[$counter]["evaluation_type"] = $evaluation_type;
                $result[$counter]["type"]            = strtolower($type);

                $counter++;
            }
        }

        return $result;
    }

    public function myEvaluation() {
        $this->checkuserPermission("my_evaluation");

        $data["employee_id"]     = $_SESSION["user_id"];
        $data["departments"]     = $this->employee_model->getDepartmentList();
        $data["department_id"]   = array_column($data["departments"], "department_title", "department_id");
        $data["positions"]       = $this->evaluation_model->getPositions();
        $data["evaluations"]     = $this->evaluation_model->getEmployeeEvalutions($data["employee_id"]);

        $this->loadView("evaluation/my_evaluation", $data);

    }

    public function employeeEvaluation() {
        $this->checkuserPermission("employee_evaluation");

        $evaluation_id        = (!empty($_POST["evaluation-id"])) ? $_POST["evaluation-id"] : '';
        $evaluation_attribute = $this->evaluation_model->getEvaluationAttribute();
        $attribute_ids        = array_column($evaluation_attribute, "attr_title", "attr_id");
        $evaluation_data      = $this->evaluation_model->getEvaluationData(array_keys($attribute_ids));

        if(!empty($evaluation_id)) {
            $data["evaluation_attribute"] = $evaluation_attribute;
            $data["evaluation_data"]      = $evaluation_data;
            $data["evaluation_detail"]    = $this->evaluation_model->getEvaluationDetail($evaluation_id);
            $data["evaluation_id"]        = $evaluation_id;

            $this->load->view("evaluation/employee_evaluation", $data);
        }
    }

    public function processEvaluation() {
        $result                 = array();
        $result["error"]        = false;
        $result["message"]      = "Evaluation Successfully Submitted.";
        $comments               = (!empty($_POST["comments"])) ? $_POST["comments"] : array();
        $recommendations        = (!empty($_POST["recommendations"])) ? $_POST["recommendations"] : array();
        $emp_evaluation         = (!empty($_POST["evaluation"])) ? $_POST["evaluation"] : array();
        $evaluation_list_id     = (!empty($_POST["evaluation_id"])) ? $_POST["evaluation_id"] : 0;
        $insert_evaluation      = 0;
        $general                = (!empty($_POST["general"])) ? $_POST["general"] : array();

        if(!empty($emp_evaluation) && !empty($evaluation_list_id)) {
            $comments           = $this->evaluation_model->prepareCommentRecommendations($comments);
            $recommendations    = $this->evaluation_model->prepareCommentRecommendations($recommendations);
            $evaluation_result  = $this->evaluation_model->getEvaluationResult($emp_evaluation);
            $evaluation_result  = $this->evaluation_model->prepareEvaluationResult($evaluation_result, $evaluation_list_id, $comments, $recommendations);
            $remove_evaluation  = $this->evaluation_model->removePreviousEvaluationResult($evaluation_list_id); //remove (if exist) evaluation result
            $insert_evaluation  = $this->evaluation_model->inserEvaluationResult($evaluation_result);
            $update_eval_status = $this->evaluation_model->evaluationUpdateStatus($evaluation_list_id, $insert_evaluation);
            $general_data       = $this->evaluation_model->prepareGeneralData($evaluation_list_id, $general);
            $delete_general     = $this->evaluation_model->deleteGeneralEvaluation($evaluation_list_id);
            $general_value      = $this->evaluation_model->insertGeneralEvaluation($general_data);
        }

        if($insert_evaluation == 0) {
            $result["error"] = true;
            $result["message"] = "Error Occured while submitting evaluation.";
        }

        echo json_encode($result);
    }

    public function getEmployeeEvaluationResult() {
        $data               = array();
        $evaluation_list_id = (!empty($_POST["evaluation_list_id"])) ? $_POST["evaluation_list_id"] : 0;

        if(!empty($evaluation_list_id)) {
            $data["eval_data"]    = $this->evaluation_model->getEmployeeEvaluationResult($evaluation_list_id);
            $data["general_data"] = $this->evaluation_model->getGeneralEvaluationData($evaluation_list_id);
        }

        echo json_encode($data);
    }

    public function getDepartmentEmployee(){
        $result     = array();

        $emp_head   = (!empty($_POST["emp_head"])) ? $_POST["emp_head"] : 0;
        $department = (!empty($_POST["department"])) ? $_POST["department"] : 0;

        if(!empty($emp_head) && !empty($department)) {
            $result["employee_list"] = $this->evaluation_model->getEmployeeByDepartment($emp_head, $department);
        }

        echo json_encode($result);
    }

    public function settings() {
        $data              = array();
        $data["emp_heads"] = $this->evaluation_model->getAllEmployeeByDepartmentHead();
        $data["employees"] = $this->evaluation_model->getAllEmployeeNames();
        
        $this->loadView("evaluation/settings", $data);
    }

    public function getDepartmentTree() {
        $result   =  array();
        $emp_head = (!empty($_POST["emp_head"])) ? $_POST["emp_head"] : 0;

        if(!empty($emp_head)) {
            $result = $this->evaluation_model->getDepartmentTree($emp_head);
        }

        echo json_encode($result);
    }

    public function saveDepartmentTree() {
        $result            = array();
        $result["error"]   = false;
        $result["message"] = "";
        $emp_head          = (!empty($_POST["emp_head"])) ? $_POST["emp_head"] : 0;
        $employees         = (!empty($_POST["employees"])) ? $_POST["employees"] : array();
        $insert_emp        = array();
        $remove_emp        = array();

        if(!empty($emp_head)) {
            $under_employees = $this->evaluation_model->getDepartmentTree($emp_head);

            if(!empty($employees)) {
                $insert_emp = array_diff($employees, $under_employees);
                $remove_emp = array_diff($under_employees, $employees);
            } else {
                $this->evaluation_model->removeDepartmentTree($remove_emp, $emp_head);
            }

            if(!empty($remove_emp)) {
                $remove = $this->evaluation_model->removeDepartmentTree($remove_emp, $emp_head);
            }

            if(!empty($insert_emp)) {
                $insert_data = $this->evaluation_model->prepareInsertDeparmentTree($insert_emp, $emp_head);
                $insert      = $this->evaluation_model->insertDepartmentTree($insert_data);
            }

            $result["message"] = "Settings Successfully updated.";
        } else {
            $result["error"]   = true;
            $result["message"] = "Please select employee head.";
        }

        echo json_encode($result);
    }

    public function noticeExplain() {
        $this->checkuserPermission("nop");

        $data = array();
        $data["employees"] = $this->evaluation_model->getAllEmployeeNames();

        $this->loadView("evaluation/notice_explain", $data);
    }

    public function saveNTE() {
        $data["employee_id"]          = (!empty($_POST["employee_id"])) ? $this->sanitizeText($_POST["employee_id"]) : "";
        $data["category"]             = (!empty($_POST["nte_category"])) ? $_POST["nte_category"] : "";
        $data["level"]                = (!empty($_POST["nte_level"])) ? $_POST["nte_level"] : "";
        $data["occurence"]            = (!empty($_POST["nte_occurence"])) ? $_POST["nte_occurence"] : "";
        $data["further_infraction"]   = (!empty($_POST["nte_further_infraction"])) ? $_POST["nte_further_infraction"] : "";
        $data["improvement_plan"]     = (!empty($_POST["nte_improvement_plan"])) ? $_POST["nte_improvement_plan"] : "";
        $data["commission_manner"]    = (!empty($_POST["nte_commission_manner"])) ? $_POST["nte_commission_manner"] : "";
        $data["sanction_progression"] = (!empty($_POST["nte_sanction_progression"])) ? $_POST["nte_sanction_progression"] : "";
        $data["details"]              = (!empty($_POST["nte_violation_details"])) ? $this->sanitizeText($_POST["nte_violation_details"]) : "";
        $data["date_incurred"]        = (!empty($_POST["nte_date_incurred"])) ? $_POST["nte_date_incurred"] : "";
        $data["infraction_place"]     = (!empty($_POST["nte_infraction_place"])) ? $_POST["nte_infraction_place"] : "";
        $data["manager"]              = (!empty($_POST["nte_manager"])) ? $_POST["nte_manager"] : "";

        $result = $this->formValidation($data, "NTE");

        if(!$result["error"]) {
            $data["date_incurred"] = $this->parseDate($data["date_incurred"]);
            $insert                = $this->evaluation_model->insertNTE($data);
        }

        echo json_encode($result);
    }

    private function formValidation($data, $form) {
        $result            = array();
        $result["error"]   = false;
        $result["message"] = array();

        if(!empty($data) && !empty($form)) {
            $validations                     = $this->evaluation_model->getFormValidation($form);
            $validation_result               = array();
            
            $validation_result["v_required"] = (!empty($validations["required"])) ? $this->processRequiredValidations($validations["required"], $data) : array();
            $validation_result["v_date"]     = (!empty($validations["date"])) ? $this->processDateValidations($validations["date"], $data) : array();
            
            $result                          = $this->processAllValidations($validation_result);
        }

        return $result;
    }

    private function processRequiredValidations($required, $data) {
        $result            = array();
        $result["error"]   = false;
        $result["message"] = array();

        if(!empty($required)) {
            foreach($required as $key => $column) {
                if(empty($data[$column])) {
                    $column_name                = $this->evaluation_model->getValidationColumnName($column);
                    
                    $result["error"]            =  true;
                    $result["message"][$column] = "The " . $column_name . " field is required.";
                }
            }
        }

        return $result;
    }

    private function processDateValidations($date_fields, $data) {
        $result            = array();
        $result["error"]   = false;
        $result["message"] = array();

        if(!empty($date_fields)) {
            foreach($date_fields as $key => $column) {
                if(!empty($data[$column])) {
                    $column_name = $this->evaluation_model->getValidationColumnName($column);
                    $valid_date  = $this->evaluation_model->checkValidDate($data[$column]);

                    if(!$valid_date) {
                        $result["error"]            =  true;
                        $result["message"][$column] = "The " . $column_name . " must be a valid date.";
                    }
                }
            }
        }

        return $result;
    }

    public function sanitizeText($text) {
        $result = addslashes(trim($text));

        return $result;
    }

    public function processAllValidations($validations) {
        $result                = array();
        $result["error"]       = false;
        $result["message"]     = array();
        $result["all_message"] = "";

        if(!empty($validations)) {
            foreach($validations as $type => $validation) {
                if($validation["error"]) {
                    $result["error"]   = true;
                    $result["message"] = array_merge($result["message"], $validation["message"]);
                }
            }

            $result["all_message"] = implode(" ", $result["message"]);
        }

        return $result;
    }

    public function getEmployeeManagers() {
        $result = $this->evaluation_model->getEmployeeManagers();

        echo json_encode($result);
    }

    public function getNTE() {
        $id     = (!empty($_POST["nte_selected_id"])) ? $_POST["nte_selected_id"] : 0;
        $result = $this->evaluation_model->getEmployeeNTE($id);

        echo json_encode($result);
    }

    public function parseDate($date_incurred) {
        $result = date("Y-m-d", strtotime($date_incurred));

        return $result;
    }

    public function getNTEData() {
        $id     = (!empty($_POST["nte_selected_id"])) ? $_POST["nte_selected_id"] : 0;
        $result = $this->evaluation_model->getNTEData($id);

        echo json_encode($result);
    }

    public function updateNTE() {
        $nte_id                       = (!empty($_POST["nte_id"])) ? $this->sanitizeText($_POST["nte_id"]) : "";
        $data["id"]                   = (!empty($_POST["nte_id"])) ? $this->sanitizeText($_POST["nte_id"]) : "";
        $data["employee_id"]          = (!empty($_POST["employee_id"])) ? $this->sanitizeText($_POST["employee_id"]) : "";
        $data["category"]             = (!empty($_POST["nte_category"])) ? $_POST["nte_category"] : "";
        $data["level"]                = (!empty($_POST["nte_level"])) ? $_POST["nte_level"] : "";
        $data["occurence"]            = (!empty($_POST["nte_occurence"])) ? $_POST["nte_occurence"] : "";
        $data["further_infraction"]   = (!empty($_POST["nte_further_infraction"])) ? $_POST["nte_further_infraction"] : "";
        $data["improvement_plan"]     = (!empty($_POST["nte_improvement_plan"])) ? $_POST["nte_improvement_plan"] : "";
        $data["commission_manner"]    = (!empty($_POST["nte_commission_manner"])) ? $_POST["nte_commission_manner"] : "";
        $data["sanction_progression"] = (!empty($_POST["nte_sanction_progression"])) ? $_POST["nte_sanction_progression"] : "";
        $data["details"]              = (!empty($_POST["nte_violation_details"])) ? $this->sanitizeText($_POST["nte_violation_details"]) : "";
        $data["date_incurred"]        = (!empty($_POST["nte_date_incurred"])) ? $_POST["nte_date_incurred"] : "";
        $data["infraction_place"]     = (!empty($_POST["nte_infraction_place"])) ? $_POST["nte_infraction_place"] : "";
        $data["manager"]              = (!empty($_POST["nte_manager"])) ? $_POST["nte_manager"] : "";

        $result = $this->formValidation($data, "NTE_update");

        if(!$result["error"]) {
            $data["date_incurred"] = $this->parseDate($data["date_incurred"]);
            $update                = $this->evaluation_model->updateNTE($nte_id, $data);
        }

        echo json_encode($result);
    }

    public function removeNTE() {
        $result                = array();
        $result["error"]       = false;
        $result["message"]     = "";

        if(!empty($_POST["nte_id"]) && $_POST["nte_id"] > 0) {
            $nte_id = $_POST["nte_id"];
            $delete = $this->evaluation_model->removeNTE($nte_id);

            if($delete) {
                $result["message"] = "NTE Successfully Deleted.";
            } else {
                $result["error"]       = true;
                $result["message"]     = "Failed to remove NTE.";
            }
        } else {
            $result["error"]       = true;
            $result["message"]     = "NTE Not Found.";
        }

        echo json_encode($result);
    }

    public function generateNTE() {
        $result["error"]   = false;
        $result["message"] = "";
        $result["file"]    = "";
        $nte_id            = (!empty($_POST["nte_id"])) ? $_POST["nte_id"] : 0;

        if(!empty($nte_id) && $nte_id > 0) {
            $this->load->library("nte");

            $template = $this->nte->checkTemplate("nte_template.zip");

            if($template) {
                $data = $this->evaluation_model->getEmployeeNTE($nte_id);

                $this->nte->generateTempName();
                $this->nte->copyTemplate();
                $this->nte->openZipFile();
                $this->nte->generateNTE($data);
                $this->nte->renameNTE();

                $result["file"] = $this->nte->getFileName();
                $file_exist     = $this->nte->checkCreatedFile();

                if(!$file_exist) {
                    $result["error"]   = true;
                    $result["message"] = "Unable to generate NTE report.";
                } else {
                    $result["message"] = "NTE report successfully created.";
                }
            } else {
                $result["error"]   = true;
                $result["message"] = "Template Not Found.";
            }
        } else {
            $result["error"]   = true;
            $result["message"] = "NTE Not Found.";
        }

        echo json_encode($result);
    }

    public function downloadNTE() {
        $file     = (!empty($_GET["f"])) ? $_GET["f"] : "";
        $emp_name = (!empty($_GET["e"])) ? $_GET["e"] : "";

        if(!empty($file) && !empty($emp_name)) {
            $this->load->library("nte");
            $this->load->helper('download');

            $this->nte->downloadNTE($file, $emp_name);
        }
    }

    public function noticePerformance() {
        $this->checkuserPermission("nop");

        $data              = array();
        $data["employees"] = $this->evaluation_model->getAllEmployeeNames();

        $this->loadView("evaluation/notice_performance", $data);
    }

    public function getNOPData() {
        $result                       = array();
        
        $result["employee_list"]      = $this->evaluation_model->getAllEmployeeNames(false);
        $result["employee_head_list"] = $this->evaluation_model->getEmployeeManagers(false);
        $result["nop_list"]           = $this->evaluation_model->getNOPList();
        
        echo json_encode($result);
    }

    public function addNOPData() {
        $result                    = array();
        $result["error"]           = false;
        $result["message"]         = array();

        $data = array(
            "employee"        => (!empty($_POST["employee_id"])) ? $_POST["employee_id"] : 0,
            "reason"          => (!empty($_POST["reason"])) ? trim($_POST["reason"]) : "",
            "recommended_by"  => (!empty($_POST["recommended_by"])) ? $_POST["recommended_by"] : 0,
            "submission_date" => (!empty($_POST["submission_date"])) ? date("Y-m-d", strtotime($_POST["submission_date"])) : "",
        );

        $result = $this->formValidation($data, "NOP");

        if(!$result["error"]) {
            $data["employee_id"] = $data["employee"];

            unset($data["employee"]);

            $insert = $this->evaluation_model->insertNOP($data);

            if(!$insert) {
                $result["error"]           = true;
                $result["overall_message"] = "Error Occured while inserting Data.";
            } else {
                $result["overall_message"] = "Notice of Performance successfully added.";
            }
        }

        echo json_encode($result);
    }

    public function deleteNOPData() {
        $result            = array();
        $result["error"]   = false;
        $result["message"] = "";

        $id = (!empty($_POST["nop_id"])) ? $_POST["nop_id"] : 0;

        if(!empty($id)) {
            $data = array(
                "deleted" => 1
            );

            $delete = $this->evaluation_model->deleteNOPData($id, $data);

            if($delete) {
                $result["message"] = "Notice of Performance successfully deleted.";
            } else {
                $result["error"]   = true;
                $result["message"] = "Error occured while deleting data.";
            }
        } else {
            $result["error"]   = true;
            $result["message"] = "Notice of Performance not found.";
        }

        echo json_encode($result);
    }

    public function updateStatus(){
        $result            = array();
        $result["message"] = "Error occured. Please contact system admin.";
        $result["success"] = false;
        $id                = $_POST["id"];
        if(!empty($id)){
            $update = $this->evaluation_model->updateStatus($id);
            if($update){
                $result["message"] = "Successfully deleted evaluation.";
                $result["success"] = true;
            }
        }
        echo json_encode($result);
    }
}