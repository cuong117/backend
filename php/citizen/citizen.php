<?php

function get_all_citizen()
{
    require_once("database/citizen_data.php");
    if (array_key_exists("user_id", $_POST))
        return $citizen->all_citizen($_POST['user_id']);
}

function add_citizen()
{
    require_once("database/citizen_data.php");
    if (
        array_key_exists("name", $_POST) &&
        array_key_exists("birth", $_POST) &&
        array_key_exists("gender", $_POST) &&
        array_key_exists("identifier", $_POST) &&
        array_key_exists("address_id", $_POST) &&
        array_key_exists("permanent_address_id", $_POST) &&
        array_key_exists("temp_address_id", $_POST) &&
        array_key_exists("religion", $_POST) &&
        array_key_exists("education", $_POST) &&
        array_key_exists("job", $_POST) &&
        array_key_exists("report_id", $_POST) &&
        array_key_exists("user_id", $_POST)
    ) {
        if (
            trim($_POST['name']) && trim($_POST["address_id"]) && trim($_POST["permanent_address_id"]) &&
            trim($_POST["temp_address_id"]) && trim($_POST["report_id"]) && trim($_POST['user_id']) && trim($_POST['birth'])
        ) {
            $result = $citizen->insert_citizen(
                $_POST["name"],
                $_POST["birth"],
                $_POST["gender"],
                $_POST["identifier"],
                $_POST["address_id"],
                $_POST['permanent_address_id'],
                $_POST['temp_address_id'],
                $_POST["religion"],
                $_POST["education"],
                $_POST["job"],
                $_POST["report_id"],
                $_POST['user_id']
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

function modify_citizen()
{
    require_once("database/citizen_data.php");
    if (
        array_key_exists("name", $_POST) &&
        array_key_exists("birth", $_POST) &&
        array_key_exists("gender", $_POST) &&
        array_key_exists("identifier", $_POST) &&
        array_key_exists("address_id", $_POST) &&
        array_key_exists("permanent_address_id", $_POST) &&
        array_key_exists("temp_address_id", $_POST) &&
        array_key_exists("religion", $_POST) &&
        array_key_exists("education", $_POST) &&
        array_key_exists("job", $_POST) &&
        array_key_exists("citizen_id", $_POST) &&
        array_key_exists("user_id", $_POST)
    ) {
        if (
            trim($_POST['name']) != "" && trim($_POST["address_id"]) != "" && trim($_POST["permanent_address_id"]) != "" &&
            trim($_POST["temp_address_id"]) != "" && trim($_POST['user_id']) != "" && trim($_POST['citizen_id']) != ""
        ) {
            $result = $citizen->update_citizen(
                $_POST["name"],
                $_POST["birth"],
                $_POST["gender"],
                $_POST["identifier"],
                $_POST["address_id"],
                $_POST['permanent_address_id'],
                $_POST['temp_address_id'],
                $_POST["religion"],
                $_POST["education"],
                $_POST["job"],
                $_POST['user_id'],
                $_POST["citizen_id"]
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

function del_citizen()
{
    require_once("database/citizen_data.php");
    if (array_key_exists("citizen_id", $_POST)) {
        if (trim($_POST["citizen_id"])) {
            $result = $citizen->delete_citizen($_POST["citizen_id"]);
            $ob = new stdClass();
            if ($result) {
                $ob->status = "ok";
            } else
                $ob->status = "fail";
            return $ob;
        }
    }
}

function citizen_of_city(){
    require_once("database/citizen_data.php");
    if (array_key_exists("city_id", $_POST)) {
        if (trim($_POST["city_id"])) {
            return $citizen->get_citizen_from_city($_POST["city_id"]);
        }
    }
}

function citizen_of_district(){
    require_once("database/citizen_data.php");
    if (array_key_exists("district_id", $_POST)) {
        if (trim($_POST["district_id"])) {
            return $citizen->get_citizen_from_district($_POST["district_id"]);
        }
    }
}

function citizen_of_commune(){
    require_once("database/citizen_data.php");
    if (array_key_exists("commune_id", $_POST)) {
        if (trim($_POST["commune_id"])) {
            return $citizen->get_citizen_from_commune($_POST["commune_id"]);
        }
    }
}

function citizen_of_address(){
    require_once("database/citizen_data.php");
    if (array_key_exists("address_id", $_POST)) {
        if (trim($_POST["address_id"])) {
            return $citizen->get_citizen_from_address1($_POST["address_id"]);
        }
    }
}
