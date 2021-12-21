<?php

function get_all_citizen(){
    require_once("database/citizen_data.php");
    if(array_key_exists("user_id", $_POST))
        return $citizen->all_citizen($_POST['user_id']);
}

function add_citizen(){
    require_once("database/citizen_data.php");
    if(
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
    ) 
    {
        if(
            trim($_POST['name']) != "" && trim($_POST["address_id"]) != "" && trim($_POST["permanent_address_id"]) != "" &&
            trim($_POST["temp_address_id"]) != "" && trim($_POST["report_id"]) != "" && trim($_POST['user_id']))
        {
            $result = $citizen->insert_citizen($_POST["name"], $_POST["birth"], $_POST["gender"], $_POST["identifier"], $_POST["address_id"],
                                             $_POST['permanent_address_id'], $_POST['temp_address_id'], $_POST["religion"], $_POST["education"], 
                                             $_POST["job"], $_POST["report_id"], $_POST['user_id']);
            $ob = new stdClass();
            if($result){
                $ob -> status = "ok";
            }else
                $ob -> status = "fail";
            return $ob; 
        }    
    }
}

function modify_citizen(){
    require_once("database/citizen_data.php");
    if(
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
    ) 
    {
        if(
            trim($_POST['name']) != "" && trim($_POST["address_id"]) != "" && trim($_POST["permanent_address_id"]) != "" &&
            trim($_POST["temp_address_id"]) != "" && trim($_POST['user_id']) != "")
        {
            $result = $citizen->update_citizen($_POST["name"], $_POST["birth"], $_POST["gender"], $_POST["identifier"], $_POST["address_id"],
                                             $_POST['permanent_address_id'], $_POST['temp_address_id'], $_POST["religion"], $_POST["education"], 
                                             $_POST["job"], $_POST['user_id'], $_POST["citizen_id"]);
            $ob = new stdClass();
            if($result){
                $ob -> status = "ok";
            }else
                $ob -> status = "fail";
            return $ob; 
        }    
    }
}

function del_citizen(){
    require_once("database/citizen_data.php");
    if(array_key_exists("citizen_id", $_POST)){
        $result = $citizen->delete_citizen($_POST["citizen_id"]);
        $ob = new stdClass();
        if($result){
            $ob -> status = "ok";
        }else
            $ob -> status = "fail";
        return $ob; 
    }
}
