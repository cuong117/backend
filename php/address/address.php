<?php

function get_city_from_user(){
    require_once('database/address_data.php');
    if(array_key_exists('user_id', $_POST)){
        if(trim($_POST['user_id'])){
            return $address->get_city_of_user($_POST['user_id']);
        }
    }
}

function get_district_from_user(){
    require_once('database/address_data.php');
    if(array_key_exists('user_id', $_POST)){
        if(trim($_POST['user_id'])){
            return $address->get_district_of_user($_POST['user_id']);
        }
    }
}

function get_commune_from_user(){
    require_once('database/address_data.php');
    if(array_key_exists('user_id', $_POST)){
        if(trim($_POST['user_id'])){
            return $address->get_commune_of_user($_POST['user_id']);
        }
    }
}

function get_address_from_user(){
    require_once('database/address_data.php');
    if(array_key_exists('user_id', $_POST)){
        if(trim($_POST['user_id'])){
            return $address->get_address_of_user($_POST['user_id']);
        }
    }
}

function get_district_from_city(){
    require_once('database/address_data.php');
    if(array_key_exists('city_id', $_POST)){
        if(trim($_POST['city_id'])){
            return $address->get_district_of_city($_POST['city_id']);
        }
    }
}

function get_commune_from_district(){
    require_once('database/address_data.php');
    if(array_key_exists('district_id', $_POST)){
        if(trim($_POST['district_id'])){
            return $address->get_commune_of_district($_POST['district_id']);
        }
    }
}

function get_address_from_commune(){
    require_once('database/address_data.php');
    if(array_key_exists('commune_id', $_POST)){
        if(trim($_POST['commune_id'])){
            return $address->get_address_of_commune($_POST['commune_id']);
        }
    }
}

function add_city(){
    require_once('database/address_data.php');
    if
    (
        array_key_exists('user_id', $_POST) &&
        array_key_exists('city_id', $_POST) &&
        array_key_exists('city_name', $_POST) 
    )
    {
        if(trim($_POST['user_id']) && trim($_POST['city_id']) && trim($_POST['city_name'])){
            $result = $address->add_city($_POST['user_id'], $_POST['city_id'], $_POST['city_name']);
            $ob = new stdClass();
            if ($result) {
                $ob->status = "ok";
            } else
                $ob->status = "fail";
            return $ob;
        }
    }
}

function add_district(){
    require_once('database/address_data.php');
    if
    (
        array_key_exists('user_id', $_POST) &&
        array_key_exists('district_id', $_POST) &&
        array_key_exists('district_name', $_POST) &&
        array_key_exists('city_id', $_POST)
    )
    {
        if(trim($_POST['user_id']) && trim($_POST['district_id']) && trim($_POST['district_name']) && trim($_POST['city_id'])){
            $result = $address->add_district($_POST['user_id'], $_POST['district_id'], $_POST['district_name'], $_POST['city_id']);
            $ob = new stdClass();
            if ($result) {
                $ob->status = "ok";
            } else
                $ob->status = "fail";
            return $ob;
        }
    }
}

function add_commune(){
    require_once('database/address_data.php');
    if
    (
        array_key_exists('user_id', $_POST) &&
        array_key_exists('commune_id', $_POST) &&
        array_key_exists('commune_name', $_POST) &&
        array_key_exists('district_id', $_POST)
    )
    {
        if(trim($_POST['user_id']) && trim($_POST['commune_id']) && trim($_POST['commune_name']) && trim($_POST['district_id'])){
            $result = $address->add_commune($_POST['user_id'], $_POST['commune_id'], $_POST['commune_name'], $_POST['district_id']);
            $ob = new stdClass();
            if ($result) {
                $ob->status = "ok";
            } else
                $ob->status = "fail";
            return $ob;
        }
    }
}

function add_address(){
    require_once('database/address_data.php');
    if
    (
        array_key_exists('user_id', $_POST) &&
        array_key_exists('address_id', $_POST) &&
        array_key_exists('address_name', $_POST) &&
        array_key_exists('commune_id', $_POST)
    )
    {
        if(trim($_POST['user_id']) && trim($_POST['address_id']) && trim($_POST['address_name']) && trim($_POST['commune_id'])){
            $result = $address->add_address($_POST['user_id'], $_POST['address_id'], $_POST['address_name'], $_POST['commune_id']);
            $ob = new stdClass();
            if ($result) {
                $ob->status = "ok";
            } else
                $ob->status = "fail";
            return $ob;
        }
    }
}