<?php
header("Access-Control-Allow-Origin: *");

function login()
{
    require_once('database/account_data.php');
    $res = new stdClass();
    $acc = $_POST['account'];
    $pass = $_POST['password'];
    $result = $account_data->check_account($acc, $pass);
    if ($result !== false && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $res->type = $row['type'];
        $res->login = true;
        $res->first_login = $row['first_login'];
        $res->user_id = $row['user_id'];
    } else {
        $res->type = Null;
        $res->login = false;
    }
    return $res;
}

function add_account()
{
    require_once('database/account_data.php');
    $res = new stdClass();
    $user_exits = false;
    $success = true;
    if (
        array_key_exists('user_id', $_POST) &&
        array_key_exists('account', $_POST) &&
        array_key_exists("id", $_POST)
    ) {
        if (trim($_POST['account']) != "" && trim($_POST['id']) != "") {
            if (!$account_data->check_user_exit($_POST['account'])) {
                $result = $account_data->insert_user($_POST['account'], $_POST['user_id'], $_POST['id']);
                if (!$result)
                    $success = false;
            } else {
                $success = false;
                $user_exits = true;
            }
        } else {
            $success = false;
        }

        $res->success = $success;
        $res->user_exits = $user_exits;

        return $res;
    }
}

function first_login()
{
    require_once("database/account_data.php");
    $res = new stdClass();
    if (
        array_key_exists('user_id', $_POST) &&
        array_key_exists('password', $_POST) &&
        array_key_exists('name', $_POST)
    ) {
        if (trim($_POST['user_id']) && trim($_POST['password']) && trim($_POST['name'])) {
            $result = $account_data->change_first_login($_POST['user_id'], $_POST['name'], $_POST['password']);
            if ($result) {
                $res->status = 'ok';
            } else
                $res->status = "fail";
            return $res;
        }
    }
}

function get_staff()
{
    require_once("database/account_data.php");
    $res = new stdClass();
    if (array_key_exists('user_id', $_POST)) {
        if (trim($_POST['user_id'])) {
            $res->status = "ok";
            $res->staff = $account_data->get_staff($_POST['user_id']);
            return $res;
        }
    }
}
