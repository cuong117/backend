<?php

require_once("database/database.php");

class Account extends Database{
    public function check_account($acc, $pass){
        $query = 'select u.user_id, u.type, u.first_login from user u where u.account = "'.$acc.'" and u.password = "'.$pass.'"';
        return $this->connect->query($query);
    }

    public function insert_user($acc, $user_id, $id){
        $type = $this->type_of_user($user_id);
        if($type == "A1"){
            $type = "A2";
        }elseif($type == "A2"){
            $type = "A3";
        }elseif($type == "A3"){
            $type = "B1";
        }elseif($type == "B1"){
            $type = "B2";
        }
        $query = "insert into user (user_id, account, password, type, boss) values (NULL, '".$acc."', '123456', '".$type."', $user_id)";
        $this->connect->query($query);
        
        $staff_id = $this->connect->query("SELECT max(u.user_id) id from user u;");
        if($staff_id -> num_rows > 0){
            $row = $staff_id -> fetch_assoc();
            $staff_id = $row['id'];
        }

        $staff_address = "";
        if ($type == "A2"){
            $staff_address = "INSERT INTO `user_a2` (`user_id`, `city_id`) VALUES ($staff_id, '$id')";
        }elseif ($type == "A3"){
            $staff_address = "INSERT INTO `user_a3` (`user_id`, `district_id`) VALUES ($staff_id, '$id')";
        }elseif($type == "B1"){
            $staff_address = "INSERT INTO `user_b1` (`user_id`, `commune_id`) VALUES ($staff_id, '$id')";
        }elseif($type == "B2"){
            $staff_address = "INSERT INTO `user_b2` (`user_id`, `address_id`) VALUES ($staff_id, '$id')";
        }

        return $this->connect->query($staff_address);
        
    }

    public function check_user_exit($acc){
        $query = "select if ('".$acc."' in (SELECT account from user), true, false) exits";
        $result = $this->connect->query($query);
        if ( $result !== false && $result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['exits'];
        }
    }

    public function change_first_login($user_id, $user_name, $password){
        $query = "UPDATE `user` SET `password` = '$password', `user_name` = '$user_name', `first_login` = 0 WHERE `user`.`user_id` = $user_id";
        return $this->connect->query($query);
    }

    public function get_staff($user_id){
        $type = $this->type_of_user($user_id);
        $query = "";
        if($type == "A1"){
            $query = "SELECT u.user_id, concat_ws(' " .'-'. " ', u.user_name, c.name) name FROM user u 
            join user_a2 u2 on u.user_id = u2.user_id
            join city c on u2.city_id = c.city_id
            WHERE u.boss = $user_id";
        }elseif($type == "A2"){
            $query = "SELECT u.user_id, concat_ws(' " .'-'. " ', u.user_name, d.name) name FROM user u 
            join user_a3 u3 on u.user_id = u3.user_id
            join district d on u3.district_id = d.district_id
            WHERE u.boss = $user_id";
        }elseif($type == "A3"){
            $query = "SELECT u.user_id, concat_ws(" - ", u.user_name, c.name) FROM user u 
            join user_b1 ub1 on u.user_id = ub1.user_id
            join commune c on ub1.commune_id = c.commune_id
            WHERE u.boss = $user_id";
        }elseif($type == "B1"){
            $query = "SELECT u.user_id, concat_ws(" - ", u.user_name, a.name) FROM user u 
            join user_b2 ub2 on u.user_id = ub2.user_id
            join address a on ub2.address_id = a.address_id
            WHERE u.boss = $user_id";
        }

        $result = $this->connect->query($query);
        return $this->push_to_array($result);
    }
}

$account_data = new Account();
$account_data->get_connect();
?>