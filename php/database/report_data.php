<?php

require_once("database/database.php");

class Report extends Database {

    public function my_report($user_id){
        $query = "SELECT r.report_id, r.start_date, r.end_date, r.report_name from report r WHERE r.user_id = $user_id";
        $result = $this->connect->query($query);
        return $this->push_to_array($result);
    }

    public function boss_report($user_id){
        $query = "SELECT r.report_id, r.start_date, r.end_date, r.report_name from report r
        JOIN staff_report s on r.report_id = s.report_id WHERE s.staff_id = $user_id";

        $result = $this->connect->query($query);
        return $this->push_to_array($result);
    }

    public function insert_report($user_id, $start_date, $end_date, $report_name, $staff){
        $report = "INSERT INTO `report` (`report_id`, `user_id`, `start_date`, `end_date`, `report_name`) 
        VALUES (NULL, '$user_id', '$start_date', '$end_date', '$report_name')";

        $this->connect->query($report);

        $report_id = $this->connect->query("SELECt max(report_id) report_id from report");
        $id = null;
        if($report_id -> num_rows > 0){
            $row = $report_id->fetch_assoc();
            $id = $row['report_id'];
        }
        $result = null;
        foreach($staff as $value){
            $insert_staff = "INSERT INTO `staff_report` (`staff_id`, `report_id`) VALUES ($value, $id)";
            $result = $this->connect->query($insert_staff);
        }
        return $result;
    }

    public function update_report($report_id, $start_date, $end_date, $report_name, $staff){
        $modify_report = "UPDATE `report` SET `start_date` = '$start_date', 
        `end_date` = '$end_date', `report_name` = '$report_name' WHERE `report`.`report_id` = $report_id";

        $this->connect->query($modify_report);

        $delete_staff = "DELETE FROM `staff_report` WHERE `staff_report`.`report_id` = $report_id";
        $this->connect->query($delete_staff);
        $result = null;
        foreach($staff as $value){
            $insert_staff = "INSERT INTO `staff_report` (`staff_id`, `report_id`) VALUES ($value, $report_id)";
            $result = $this->connect->query($insert_staff);
        }
        return $result;
    }

    public function delete_report($report_id){
        $del_staff = "DELETE FROM `staff_report` WHERE `staff_report`.`report_id` = $report_id";

        $this->connect->query($del_staff);

        $del_report = "DELETE FROM `report` WHERE `report`.`report_id` = $report_id";

        $result = $this->connect->query($del_report);
        return $result;
    }

}

$report = new Report();
$report->get_connect();