<?php

class Evaluation_model extends CI_Model {
    public function getEmployeeByDepartmentHead($department) {
        $result = array();

        if(!empty($department)) {
            $sql = "SELECT
                        employee_id,
                        last_name,
                        first_name,
                        middle_name,
                        (SELECT field_value
                         FROM employment_information
                         WHERE field_name = 'type'
                         AND employee_id = employee.employee_id
                         ORDER BY empinfo_id DESC
                         LIMIT 1
                        ) as employee_type
                    FROM employee
                    WHERE employee_id IN(SELECT
                                            employee_id
                                         FROM employment_information
                                         WHERE field_name = 'department'
                                         AND field_value = {$department}
                                        )
                    AND employee.deleted = 0
                    HAVING employee_type = 'Department Head'
                   ";

            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                $result = $exe;
            }
        }

        return $result;
    }

    public function getEmployeeByDepartment($emp_head, $department) {
        $result = array();

        if(!empty($department)) {
            $sql = "SELECT
                        dt.employee_id,
                        last_name,
                        first_name,
                        middle_name,
                        dt.head,
                        (SELECT field_value
                         FROM employment_information
                         WHERE field_name = 'type'
                         AND employee_id = e.employee_id
                         ORDER BY empinfo_id DESC
                         LIMIT 1
                        ) as employee_type
                    FROM department_tree dt
                    INNER JOIN employee e
                    ON e.employee_id = dt.employee_id
                    WHERE head = {$emp_head}
                    AND dt.deleted = 0
                   ";

            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                $result = $exe;
            }
        }

        return $result;
    }

    public function insertEvaluationData($data) {
        $result = 0;

        if(!empty($data)) {
            $this->db->insert_batch('evaluation_list', $data);

            $result = $this->db->insert_id();
        }

        return $result;
    }

    public function getEvaluationList($group = "", $filter_id = 0, $filter_status = "") {
        $result            = array();
        $result["data"]    = array();
        $result["emp_ids"] = array();
        $where             = $this->getEvaluationWhere($group, $filter_id, $filter_status);

        $sql = "SELECT
                    id,
                    department,
                    evaluator,
                    evaluated,
                    status,
                    expiry_date,
                    evaluation_type,
                    type,
                    overall_comment,
                    overall_recommendation,
                    (SELECT CONCAT(last_name, ', ', first_name)
                     FROM employee
                     WHERE employee_id = evaluation_list.evaluated
                    ) as evaluated_name,
                    (SELECT
                        SUM(rating_value) as score
                    FROM evaluation_result
                    INNER JOIN evaluation
                    ON evaluation.evaluation_id = evaluation_result.evaluation_id
                    WHERE evaluation_list_id = evaluation_list.id
                    AND deleted = 0
                    AND evaluation_result.evaluation_list_id = evaluation_list.id
                    ) as score
                FROM evaluation_list
                WHERE evaluation_list.deleted = 0
                " . $where . "
                ORDER By evaluated_name
               ";

        $exe = $this->db->query($sql)->result_array();

        if(!empty($exe)) {
            foreach($exe as $key => $val) {
                $val["status_words"] = "Ongoing";

                if($val["status"] == 0 && (isset($val["expiry_date"]) && date("Y-m-d") > $val["expiry_date"])) {
                    $val["status_words"] = "Expired";
                }

                if($val["status"] == 1) {
                    $val["status_words"] = "Done";
                }

                $result["data"][$val["department"]][$val["evaluated"]][] = $val;

                $result["emp_ids"][] = $val["evaluated"];
                $result["emp_ids"][] = $val["evaluator"];
            }
        }

        return $result;
    }

    public function getEvaluations($group = "", $filter_id = 0, $filter_status = "") {
        $result            = array();
        $where             = $this->getEvaluationWhere($group, $filter_id, $filter_status);

        $sql = "SELECT
                    id,
                    department,
                    evaluator,
                    evaluated,
                    status,
                    expiry_date,
                    evaluation_type,
                    type,
                    overall_comment,
                    overall_recommendation,
                    (SELECT CONCAT(last_name, ', ', first_name)
                     FROM employee
                     WHERE employee_id = evaluation_list.evaluated
                    ) as evaluated_name,
                    (SELECT
                        SUM(rating_value) as score
                    FROM evaluation_result
                    INNER JOIN evaluation
                    ON evaluation.evaluation_id = evaluation_result.evaluation_id
                    WHERE evaluation_list_id = evaluation_list.id
                    AND deleted = 0
                    AND evaluation_result.evaluation_list_id = evaluation_list.id
                    ) as score
                FROM evaluation_list
                WHERE evaluation_list.deleted = 0
                " . $where . "
                ORDER By evaluated_name
               ";

        $exe = $this->db->query($sql)->result_array();

        if(!empty($exe)) {
            foreach($exe as $key => $val) {
                $val["status_words"] = "Ongoing";

                if($val["status"] == 0 && (isset($val["expiry_date"]) && date("Y-m-d") > $val["expiry_date"])) {
                    $val["status_words"] = "Expired";
                }

                if($val["status"] == 1) {
                    $val["status_words"] = "Done";
                }

                $result[$val["evaluator"]][] = $val;
            }
        }

        return $result;
    }

    public function getEmployeeNames($emp_ids) {
        $result = array();

        if(!empty($emp_ids)) {
            $employee_ids = implode(", ", array_unique($emp_ids));

            $sql = "SELECT
                        employee_id,
                        CONCAT(last_name, ', ', first_name) as name
                    FROM employee
                    WHERE employee_id IN(" . $employee_ids . ")
                    ORDER BY name ASC
                   ";

            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                $result = array_column($exe, "name", "employee_id");
            }
        }

        return $result;
    }

    public function getAllEmployeeNames($id_as_key = true) {
        $result = array();

        $sql = "SELECT
                    employee_id,
                    CONCAT(last_name, ', ', first_name) as name
                FROM employee
                INNER JOIN users
                ON employee.employee_id = users.user_id
                WHERE users.deleted = 0
                AND employee.deleted = 0
                AND type != 'administrator'
                ORDER BY name ASC
               ";

        $exe = $this->db->query($sql)->result_array();

        if(!empty($exe)) {
            if($id_as_key) {
                $result = array_column($exe, "name", "employee_id");
            } else {
                $result = $exe;
            }
        }

        return $result;
    }

    public function getPositions() {
        $result = array();

        $sql = "SELECT * FROM positions
                WHERE deleted = 0
               ";

        $exe = $this->db->query($sql)->result_array();

        if(!empty($exe)) {
            foreach($exe as $key => $value) {
                $result[$value["position_id"]] = $value;
            }
        }

        return $result;
    }

    public function getEmployeeEvalutions($employee_id) {
        $result             = array();
        $result["on_going"] = array();
        $result["finished"] = array();
        $result["expired"]  = array();
        $current_date       = date("Y-m-d");

        if(!empty($employee_id)) {
            $sql = "SELECT
                        evaluation_list.id as evaluation_list_id,
                        department,
                        evaluator,
                        evaluated,
                        status,
                        expiry_date,
                        CONCAT(last_name, ', ', first_name) as evaluator_name,
                        (SELECT CONCAT(last_name, ', ', first_name)
                         FROM employee
                         WHERE employee.employee_id = evaluation_list.evaluated
                        ) as evaluated_name,
                        (SELECT field_value
                         FROM employment_information
                         WHERE employment_information.employee_id = evaluation_list.evaluated
                         AND field_name = 'position'
                         ORDER BY empinfo_id DESC
                         LIMIT 1
                        ) as evaluated_position,
                        (SELECT
                            SUM(rating_value) as score
                        FROM evaluation_result
                        INNER JOIN evaluation
                        ON evaluation.evaluation_id = evaluation_result.evaluation_id
                        WHERE evaluation_list_id = evaluation_list.id
                        AND deleted = 0
                        AND evaluation_result.evaluation_list_id = evaluation_list.id
                        ) as score
                    FROM evaluation_list
                    INNER JOIN employee
                    ON employee.employee_id = evaluation_list.evaluator
                    WHERE evaluator = {$employee_id}
                    AND evaluation_list.deleted = 0
                    ORDER BY evaluated_name ASC
                   ";

            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                foreach($exe as $key => $value) {
                    if($value["status"] == 1) {
                        $result["finished"][] = $value;
                    } elseif($value["status"] == 0 && !empty($value["expiry_date"]) && strtotime($value["expiry_date"]) < strtotime($current_date)) {
                        $result["expired"][] = $value;
                    } else {
                        $result["on_going"][] = $value;
                    }
                }
            }
        }

        return $result;
    }

    public function getEvaluationDetail($evaluation_id) {
        $result = array();

        if(!empty($evaluation_id)) {
            $sql = "SELECT
                        evaluation_list.id as evaluation_list_id,
                        department,
                        evaluator,
                        evaluated,
                        status,
                        expiry_date,
                        CONCAT(last_name, ', ', first_name) as evaluator_name,
                        (SELECT CONCAT(last_name, ', ', first_name)
                         FROM employee
                         WHERE employee.employee_id = evaluation_list.evaluated
                        ) as evaluated_name,
                        (SELECT field_value
                         FROM employment_information
                         WHERE employment_information.employee_id = evaluation_list.evaluated
                         AND field_name = 'position'
                         ORDER BY empinfo_id DESC
                         LIMIT 1
                        ) as evaluated_position
                    FROM evaluation_list
                    INNER JOIN employee
                    ON employee.employee_id = evaluation_list.evaluator
                    WHERE evaluation_list.id = {$evaluation_id}
                    AND evaluation_list.deleted = 0
                    ORDER BY evaluated_name ASC
                   ";

            $exe = $this->db->query($sql)->row_array();

            if(!empty($exe)) {
                $result = $exe;
            }
        }

        return $result;
    }

    public function getEvaluationAttribute() {
        $result = array();

        $sql = "SELECT * FROM evaluation_attribute
                ORDER BY attr_id
               ";

        $exe = $this->db->query($sql)->result_array();

        if(!empty($exe)) {
            foreach($exe as $key => $value) {
                $result[$value["attr_id"]] = $value;
            }
        }

        return $result;
    }

    public function getEvaluationData($attributes) {
        $result = array();

        if(!empty($attributes)) {
            $sql = "SELECT * FROM evaluation
                    WHERE attribute_id IN(" . implode(",", $attributes) .")
                    ORDER BY attribute_id ASC, position ASC
                   ";

            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                foreach($exe as $key => $value) {
                    $result[$value['attribute_id']][$value['evaluation_id']] = $value;
                }
            }
        }

        return $result;
    }

    public function getEvaluationResult($emp_evaluation) {
        $result = array();

        if(!empty($emp_evaluation)) {
            $sql = "SELECT
                        evaluation_id,
                        attribute_id,
                        rating,
                        rating_value
                    FROM evaluation
                    WHERE evaluation_id IN(" . implode(", ", $emp_evaluation) . ")
                   ";

            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                $result = $exe;
            }
        }

        return $result;
    }

    public function prepareEvaluationResult($evaluation_result, $evaluation_list_id, $comments, $recommendations) {
        $result = array();

        if(!empty($evaluation_result) && !empty($evaluation_list_id)) {
            foreach($evaluation_result as $key => $value) {
                $result[] = array(
                                "evaluation_list_id"        => $evaluation_list_id,
                                "evaluation_id"             => $value["evaluation_id"],
                                "evaluator_comments"        => (isset($comments[$value["attribute_id"]])) ? $comments[$value["attribute_id"]] : null,
                                "evaluator_recommendations" => (isset($recommendations[$value["attribute_id"]])) ? $recommendations[$value["attribute_id"]] : null
                            );
            }
        }

        return $result;
    }

    public function inserEvaluationResult($data) {
        $result = 0;

        if(!empty($data)) {
            $this->db->insert_batch('evaluation_result', $data);

            $result = $this->db->insert_id();
        }

        return $result;
    }

    public function removePreviousEvaluationResult($evaluation_list_id) {
        if(!empty($evaluation_list_id)) {
            $sql = "UPDATE evaluation_result
                    SET deleted = 1
                    WHERE evaluation_list_id = {$evaluation_list_id}
                   ";

            $exe = $this->db->query($sql);
        }
    }

    public function evaluationUpdateStatus($evaluation_list_id, $insert_evaluation) {
        if(!empty($evaluation_list_id) && !empty($insert_evaluation)) {
            $sql = "UPDATE evaluation_list
                    SET status = 1
                    WHERE id = {$evaluation_list_id}
                   ";

            $this->db->query($sql);
        }
    }

    public function getEmployeeEvaluationResult($evaluation_list_id) {
        $result = array();

        if(!empty($evaluation_list_id)) {
            $sql = "SELECT *,
                        (SELECT overall_comment
                         FROM evaluation_list
                         WHERE id = evaluation_result.evaluation_list_id
                        ) as overall_comment,
                        (SELECT overall_recommendation
                         FROM evaluation_list
                         WHERE id = evaluation_result.evaluation_list_id
                        ) as overall_recommendation
                    FROM evaluation_attribute
                    INNER JOIN evaluation
                    ON evaluation.attribute_id = evaluation_attribute.attr_id
                    INNER JOIN evaluation_result
                    ON evaluation_result.evaluation_id = evaluation.evaluation_id
                    WHERE evaluation_result.evaluation_list_id = {$evaluation_list_id}
                    AND evaluation_result.deleted = 0
                   ";

            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                $result = $exe;
            }
        }

        return $result;
    }

    public function getEvaluationWhere($group, $filter_id, $filter_status) {
        $result = "";

        if(!empty($group) && !empty($filter_id)) {
            if($group == "By Department") {
                $result .= " AND department = {$filter_id}";
            } else {
                $result .= " AND evaluation_list.evaluated = {$filter_id}";
            }
        }

        if(!empty($filter_status)) {
            if($filter_status == "Done") {
                $result .= " AND status = 1";
            }

            if($filter_status == "Ongoing") {
                $result .= " AND status = 0 AND (expiry_date > '" . date("Y-m-d") . "' OR expiry_date IS NULL)";
            }

            if($filter_status == "Expired") {
                $result .= " AND status = 0 AND expiry_date < '" . date("Y-m-d") . "'";
            }
        }

        return $result;
    }

    public function prepareCommentRecommendations($comments) {
        $result = array();

        if(!empty($comments)) {
            foreach($comments as $key => $value) {
                foreach($value as $attr_id => $text) {
                    $result[$attr_id] = $text;
                }
            }
        }

        return $result;
    }

    public function evaluationUpdateOverAllCom($evaluation_list_id, $overall_comment, $overall_recommendation) {
        if(!empty($evaluation_list_id) && (!empty($overall_comment) || !empty($overall_recommendation))) {
            $sql = "UPDATE evaluation_list
                    SET overall_comment = '" . trim(addslashes($overall_comment)) . "',
                        overall_recommendation = '" . trim(addslashes($overall_recommendation)) . "'
                    WHERE id = {$evaluation_list_id}
                   ";

            $this->db->query($sql);
        }
    }

    public function getAllEmployeeByDepartmentHead() {
        $result = array();

        $sql = "SELECT
                    DISTINCT(e.employee_id) as employee_id,
                    last_name,
                    first_name,
                    middle_name
                FROM employment_information ei
                INNER JOIN employee e
                ON e.employee_id = ei.employee_id
                WHERE field_name = 'type'
                AND field_value = 'Department Head'
                AND ei.deleted = 0
                AND e.deleted = 0
                ORDER BY last_name, first_name
               ";

        $exe = $this->db->query($sql)->result_array();

        if(!empty($exe)) {
            $result = $exe;
        }

        return $result;
    }

    public function getDepartmentTree($emp_head) {
        $result = array();

        if(!empty($emp_head)) {
            $sql = "SELECT
                        DISTINCT(employee_id) as employee_id,
                        head,
                        id,
                        date_added
                    FROM department_tree
                    WHERE head = {$emp_head}
                    AND deleted = 0
                   ";

            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                $result = array_column($exe, "employee_id");
            }
        }

        return $result;
    }

    public function removeDepartmentTree($remove_emp, $emp_head) {
        $sql = "";

        if(!empty($remove_emp) && !empty($emp_head)) {
            $sql = "UPDATE department_tree
                    SET deleted = 1
                    WHERE head = {$emp_head}
                    AND employee_id IN(" . implode(", ", $remove_emp) . ")
                   ";
        }

        if(empty($remove_emp) && !empty($emp_head)) {
            $sql = "UPDATE department_tree
                    SET deleted = 1
                    WHERE head = {$emp_head}
                   ";
        }

        if(!empty($sql)) {
            $exe = $this->db->query($sql);
        }
    }

    public function prepareInsertDeparmentTree($insert_emp, $emp_head) {
        $result = array();

        if(!empty($insert_emp)) {
            foreach($insert_emp as $key => $value) {
                $result[] = ["head" => $emp_head, "employee_id" => $value];
            }
        }

        return $result;
    }

    public function insertDepartmentTree($insert_data) {
        if(!empty($insert_data)) {
            $this->db->insert_batch('department_tree', $insert_data);
        }
    }

    public function insertGeneralEvaluation($general_data) {
        if(!empty($general_data)) {
            $this->db->insert_batch('evaluation_general', $general_data);
        }
    }

    public function prepareGeneralData($evaluation_list_id, $general) {
        $result = array();

        if(!empty($evaluation_list_id) && !empty($general)) {
            foreach($general as $column => $value) {
                $result[] = array(
                    "el_id"  => $evaluation_list_id,
                    "column" => $column,
                    "value"  => addslashes($value)
                );
            }
        }

        return $result;
    }

    public function deleteGeneralEvaluation($evaluation_list_id) {
        if(!empty($evaluation_list_id)) {
            $sql = "UPDATE evaluation_general
                    SET deleted = 1
                    WHERE el_id = {$evaluation_list_id}
                   ";

            $this->db->query($sql);
        }
    }

    public function getGeneralEvaluationData($evaluation_list_id) {
        $result = array();

        if(!empty($evaluation_list_id)) {
            $sql = "SELECT * FROM evaluation_general
                    WHERE el_id  = {$evaluation_list_id}
                    AND deleted = 0
                   ";

            $exe = $this->db->query($sql)->result_array();

            if(!empty($exe)) {
                $result = array_column($exe, "value", "column");
            } else {
                $result["development"]            = "";
                $result["improvement"]            = "";
                $result["overall_recommendation"] = "";
                $result["strength"]               = "";
                $result["weakness"]               = "";
            }
        }

        return $result;
    }

    public function getFormValidation($form) {
        $result = array();

        if($form == "NTE") {
            $result = array(
                "required" => array("details", "employee_id", "category", "level"),
                "date"     => array("date_incurred")
            );
        }

        if($form == "NTE_update") {
            $result = array(
                "required" => array("id", "details", "employee_id", "category", "level"),
                "date"     => array("date_incurred")
            );
        }

        if($form == "NOP") {
            $result = array(
                "required" => array("employee", "reason", "recommended_by", "submission_date"),
                "date"     => array("submission_date")
            );
        }

        return $result;
    }

    public function getValidationColumnName($column) {
        $result = "";

        if(!empty($column)) {
            $result = ucwords(str_replace("_", " ", $column));
        }

        return $result;
    }

    public function checkValidDate($date) {
        $result = false;

        if(!empty($date)) {
            if(strtotime($date)) {
                $tmp_date = date("Y-m-d", strtotime($date));
                $exp      = explode("-", $tmp_date);
                $result   = checkdate($exp[1], $exp[2], $exp[0]);
            }
        }

        return $result;
    }

    public function insertNTE($data) {
        $result = 0;

        if(!empty($data)) {
            $result = $this->db->insert('nte', $data);
        }

        return $result;
    }

    public function getEmployeeManagers($id_as_key = true) {
        $result = array();

        $sql = "SELECT
                    DISTINCT(head) as head_id,
                    CONCAT(last_name, ', ', first_name) as head_name
                FROM department_tree dt
                INNER JOIN employee e
                ON e.employee_id = dt.head
                ORDER BY head_name ASC
               ";

        $exe = $this->db->query($sql)->result_array();

        if(!empty($exe)) {
            if($id_as_key) {
                $result = array_column($exe, "head_name", "head_id");
            } else {
                $result = $exe;
            }
        }

        return $result;
    }

    public function getEmployeeNTE($id = 0) {
        $result = array();
        $where  = "";
        if(!empty($id)) {
            $where = " AND nte.id = {$id}";
        }

        $sql = "SELECT
                    nte.id,
                    CONCAT(UCASE(last_name), ', ', UCASE(first_name)) as employee_name,
                    category as misconduct_category,
                    level as misconduct_level,
                    occurence,
                    further_infraction,
                    improvement_plan,
                    commission_manner,
                    sanction_progression,
                    details,
                    sanction,
                    IF(date_incurred, date_format(date_incurred, '%Y-%m-%d'),NULL) as date_incurred,
                    infraction_place,
                    (SELECT CONCAT(UCASE(last_name), ', ', UCASE(first_name))
                     FROM employee se WHERE se.employee_id = nte.manager
                    ) as manager_name,
                    (SELECT department_title
                     FROM departments d
                     INNER JOIN employment_information ei
                     ON ei.field_value = d.department_id
                     WHERE field_name = 'department'
                     AND ei.employee_id = e.employee_id
                     ORDER BY ei.empinfo_id
                     LIMIT 1
                    ) as department,
                    (SELECT position_title
                     FROM positions p
                     INNER JOIN employment_information ei
                     ON ei.field_value = p.position_id
                     WHERE field_name = 'position'
                     AND ei.employee_id = e.employee_id
                     ORDER BY ei.empinfo_id
                     LIMIT 1
                    ) as position
                FROM nte
                INNER JOIN employee e
                ON e.employee_id = nte.employee_id
                WHERE nte.deleted = 0
               " . $where;

        if(!empty($id)) {
            $exe = $this->db->query($sql)->row_array();
        } else {
            $exe = $this->db->query($sql)->result_array();
        }

        if(!empty($exe)) {
            $result = $exe;
        }

        return $result;
    }

    public function getNTEData($id) {
        $result = array();

        if(!empty($id)) {
            $sql = "SELECT * FROM nte
                    WHERE id = {$id}
                   ";

            $exe = $this->db->query($sql)->row_array();

            if(!empty($exe)) {
                $exe["date_incurred"] = (!empty($exe["date_incurred"]) && $exe["date_incurred"] <> '0000-00-00 00:00:00') ? date("m/d/Y", strtotime($exe["date_incurred"])) : "";
                $result = $exe;
            }
        }

        return $result;
    }

    public function updateNTE($nte_id, $data) {
        $result = 0;

        if(!empty($nte_id) && !empty($data)) {
            $this->db->where('id', $nte_id);

            $result = $this->db->update('nte', $data);
        }

        return $result;
    }

    public function removeNTE($nte_id) {
        $result = 0;

        if(!empty($nte_id)) {
            $this->db->set('deleted', 1);
            $this->db->where('id', $nte_id);

            $result = $this->db->update('nte');
        }

        return $result;
    }

    public function insertNOP($data) {
        $result = 0;

        if(!empty($data)) {
            $result = $this->db->insert('nop', $data);
        }

        return $result;
    }

    public function getNOPList() {
        $result  = array();

        $sql = "SELECT
                    id,
                    employee_id,
                    reason,
                    recommended_by,
                    IF(submission_date, date_format(submission_date, '%Y-%m-%d'),NULL) as submission_date,
                    (SELECT CONCAT(last_name, ', ', first_name)
                     FROM employee
                     WHERE employee.employee_id = nop.employee_id
                    ) as employee_name,
                    (SELECT CONCAT(last_name, ', ', first_name)
                     FROM employee
                     WHERE employee.employee_id = nop.recommended_by
                    ) as recommended_by_name
                FROM nop
                WHERE deleted = 0
               ";

        $exe = $this->db->query($sql)->result_array();

        if(!empty($exe)) {
            $result = $exe;
        }

        return $result;
    }

    public function deleteNOPData($id, $data) {
        $result = false;

        if(!empty($id) && !empty($data)) {
            $this->db->where('id', $id);
            $result = $this->db->update('nop', $data);
        }

        return $result;
    }

    public function updateStatus($id){
        $result = false;
        if(!empty($id)){
            $sql = "UPDATE evaluation_list SET deleted = 1 WHERE id = ? ";
            $exe = $this->db->query($sql, array($id));
            $aff = $this->db->affected_rows();
            if($aff){
                $result = true;
            }
        }
        return $result;
    }
}