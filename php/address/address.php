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