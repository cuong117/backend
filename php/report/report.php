<?php

function get_report_of_user()
{
    require_once('database/report_data.php');
    if (array_key_exists('user_id', $_POST)) {
        if (trim($_POST['user_id'])) {
            $res = new stdClass();
            $res->status = "ok";
            $res->my_report = $report->my_report($_POST['user_id']);
            $res->boss_report = $report->boss_report($_POST['user_id']);
            return $res;
        }
    }
}

function add_report()
{
    require_once('database/report_data.php');
    if (
        array_key_exists("user_id", $_POST) &&
        array_key_exists("start_date", $_POST) &&
        array_key_exists('end_date', $_POST) &&
        array_key_exists('report_name', $_POST) &&
        array_key_exists('staff', $_POST)
    ) {
        if (
            trim($_POST['user_id']) && trim($_POST['start_date']) && trim($_POST['end_date']) &&
            trim($_POST['report_name']) && trim($_POST['staff'])
        ) {
            $_POST["staff"] = json_decode($_POST['staff']);
            $result = $report->insert_report(
                $_POST['user_id'],
                $_POST['start_date'],
                $_POST['end_date'],
                $_POST['report_name'],
                $_POST['staff']
            );
            $ob = new stdClass();
            if ($result) {
                $ob->status = "ok";
            } else
                $ob->status = "fail";
            return $ob;
        }
    }
}

function modify_report()
{
    require_once('database/report_data.php');
    if (
        array_key_exists("report_id", $_POST) &&
        array_key_exists("start_date", $_POST) &&
        array_key_exists('end_date', $_POST) &&
        array_key_exists('report_name', $_POST) &&
        array_key_exists('staff', $_POST)
    ) {
        if (
            trim($_POST['report_id']) && trim($_POST['start_date']) && trim($_POST['end_date']) &&
            trim($_POST['report_name']) && trim($_POST['staff'])
        ) {
            $_POST["staff"] = json_decode($_POST['staff']);
            $result = $report->update_report(
                $_POST['report_id'],
                $_POST['start_date'],
                $_POST['end_date'],
                $_POST['report_name'],
                $_POST['staff']
            );
            $ob = new stdClass();
            if ($result) {
                $ob->status = "ok";
            } else
                $ob->status = "fail";
            return $ob;
        }
    }
}

function del_report()
{
    require_once('database/report_data.php');
    if (array_key_exists('report_id', $_POST)) {
        if (trim($_POST['report_id'])) {
            $result = $report->delete_report($_POST['report_id']);
            $ob = new stdClass();
            if ($result) {
                $ob->status = "ok";
            } else
                $ob->status = "fail";
            return $ob;
        }
    }
}
