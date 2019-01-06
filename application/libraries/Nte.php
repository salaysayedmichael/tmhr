<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nte {
    public $template_path = FCPATH . "assets/templates/";
    public $download_path = FCPATH . "assets/downloads/";
    public $base_path     = "";
    public $temp_name     = "";
    public $template_name = "";
    public $zip;

    public function __construct() {
        $this->base_path =  base_url("../assets/downloads/");
        $this->zip       = new ZipArchive;
    }

    public function checkTemplate($file_name) {
        $result = false;

        if(!empty($file_name)) {
            $result              = file_exists($this->template_path . $file_name);
            $this->template_name = $file_name;
        }

        return $result;
    }

    public function generateTempName() {
        $name            = date("Y-m-d m:i:s");
        $this->temp_name = base64_encode($name) . ".zip";
    }

    public function copyTemplate() {
        $result = copy($this->template_path . $this->template_name, $this->download_path . $this->temp_name);

        return $result;
    }

    public function openZipFile() {
        $this->zip->open($this->download_path . $this->temp_name);
    }

    public function generateNTE($data) {
        if(!empty($data)) {
            $oldContents = $this->zip->getFromName("word/document.xml");
            $date        = date("d F, Y");
            $hr_mc_a     = (!empty($data["misconduct_category"]) && $data["misconduct_category"] == "Work Performance and Productivity") ? "x" : "";
            $hr_mc_b     = (!empty($data["misconduct_category"]) && $data["misconduct_category"] == "Attendance") ? "x" : "";
            $hr_mc_c     = (!empty($data["misconduct_category"]) && $data["misconduct_category"] == "Professional Conduct") ? "x" : "";
            $hr_mc_d     = (!empty($data["misconduct_category"]) && $data["misconduct_category"] == "Protection and Property") ? "x" : "";
            $hr_mc_e     = (!empty($data["misconduct_category"]) && $data["misconduct_category"] == "Health, Safety and Physical Security") ? "x" : "";

            $hr_ml_a     = (!empty($data["misconduct_level"]) && $data["misconduct_level"] == "Minor A") ? "x" : "";
            $hr_ml_b     = (!empty($data["misconduct_level"]) && $data["misconduct_level"] == "Minor B") ? "x" : "";
            $hr_ml_s     = (!empty($data["misconduct_level"]) && $data["misconduct_level"] == "Serious") ? "x" : "";
            $hr_ml_g     = (!empty($data["misconduct_level"]) && $data["misconduct_level"] == "Grave") ? "x" : "";

            $hr_ps_d     = (!empty($data["sanction_progression"]) && $data["sanction_progression"] == "Documented Verbal Coaching") ? "x" : "";
            $hr_ps_f     = (!empty($data["sanction_progression"]) && $data["sanction_progression"] == "Final Written Reprimand") ? "x" : "";
            $hr_ps_w     = (!empty($data["sanction_progression"]) && $data["sanction_progression"] == "Written Reprimand") ? "x" : "";
            $hr_ps_s     = (!empty($data["sanction_progression"]) && $data["sanction_progression"] == "Suspension") ? "x" : "";
            $hr_ps_t     = (!empty($data["sanction_progression"]) && $data["sanction_progression"] == "Termination") ? "x" : "";

            //replace words
            $prev_words = array(
                "hr_employee_name",
                "hr_employee_id",
                "hr_manager",
                "hr_date",
                "hr_job_title",
                "hr_department",
                "Hr_mc_a",
                "Hr_mc_b",
                "Hr_mc_c",
                "Hr_mc_d",
                "Hr_mc_e",
                "Hr_ml_a",
                "Hr_ml_b",
                "Hr_ml_s",
                "Hr_ml_g",
                "hr_occ_num",
                "hr_occ_misconduct",
                "Hr_ps_d",
                "Hr_ps_f",
                "Hr_ps_w",
                "Hr_ps_s",
                "Hr_ps_t",
                "hr_infraction_date",
                "hr_infraction_place",
                "hr_commision_manner",
                "hr_violation_details",
                "hr_improvement_plan",
                "hr_further_infractions",
                "hr_mb"
            );

            $new_words  = array(
               $data["employee_name"],
                "",
                $data["manager_name"],
                $date,
                $data["position"],
                $data["department"],
                $hr_mc_a,
                $hr_mc_b,
                $hr_mc_c,
                $hr_mc_d,
                $hr_mc_e,
                $hr_ml_a,
                $hr_ml_b,
                $hr_ml_s,
                $hr_ml_g,
                $data["occurence"],
                "Occurrence of Misconduct",
                $hr_ps_d,
                $hr_ps_f,
                $hr_ps_w,
                $hr_ps_s,
                $hr_ps_t,
                (!empty($data["date_incurred"])) ? date("d F, Y", strtotime($data["date_incurred"])) : "",
                $data["infraction_place"],
                $data["commission_manner"],
                $data["details"],
                $data["improvement_plan"],
                $data["further_infraction"],
                $data["misconduct_category"]
            );

            $newContents = str_replace($prev_words, $new_words, $oldContents);

            $this->zip->deleteName("word/document.xml");
            $this->zip->addFromString("word/document.xml", $newContents);

            $this->zip->close();
        }
    }

    public function renameNTE() {
        rename($this->download_path . $this->temp_name, $this->download_path . str_replace(".zip", ".docx", $this->temp_name));
    }

    public function getFileName() {
        $result = str_replace(".zip", "", $this->temp_name);

        return $result;
    }

    public function checkCreatedFile() {
        $result = file_exists($this->download_path . str_replace(".zip", ".docx", $this->temp_name));

        return $result;
    }

    public function downloadNTE($file_name, $emp_name) {
        if(!empty($file_name)) {
            $file_name = $this->download_path . $file_name . ".docx";

            $new_file_name = ucwords($emp_name) . " - NTE";

            header('Content-Description: File Transfer');
            header('Content-Type: application/msword');
            header("Content-Disposition: attachment; filename='" . $new_file_name . ".docx");
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_name));
            ob_clean();
            flush();
            readfile($file_name);
        }
    }
}