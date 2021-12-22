<?php

require_once("database/database.php");

class Citizen extends Database
{

    public function all_citizen($id)
    {
        $type = $this->type_of_user($id);
        
        $citizen = array();
        $get_address = "";
        if ($type == "A1") {
            $query = "select c.citizen_id, c.name, c.birth, c.gender, c.identifier, get_address_name_from_id(c.address_id) address_name, 
            get_address_name_from_id(c.permanent_address_id) permanent_address_name, 
            get_address_name_from_id(c.temp_address_id) temp_address_name, c.religion, c.education, c.job from citizen c;";
            $result = $this->connect->query($query);
            return  $this->push_to_array($result);
        } else {
            if ($type == "A2") {
                $get_address = "select a.address_id from city ct
                join district d on ct.city_id = d.city_id
                join commune c on d.district_id = c.district_id
                join address a on a.commune_id = c.commune_id
                join user_A2 u on u.city_id = ct.city_id
                where u.user_id = '$id'";
            } elseif ($type == "A3") {
                $get_address = "select a.address_id from district d
                join commune c on d.district_id = c.district_id
                join address a on a.commune_id = c.commune_id
                join user_A3 u on u.district_id = d.district_id
                where u.user_id = '" . $id . "'";
            } elseif ($type == "B1") {
                $get_address = "select a.address_id from commune c
                join address a on a.commune_id = c.commune_id
                join user_B1 u on u.commune_id = c.commune_id
                where u.user_id = '" . $id . "'";
            }

            $address = $this->connect->query($get_address);
            $citizen = $this->push_citizen_of_address($address);
        }

        return $citizen;
    }

    public function get_citizen_from_city($city_id){
        $citizen = array();
        $get_address = "select a.address_id from city ct
        join district d on ct.city_id = d.city_id
        join commune c on d.district_id = c.district_id
        join address a on a.commune_id = c.commune_id
        where ct.city_id = '$city_id'";

        $address = $this->connect->query($get_address);
        $citizen = $this->push_citizen_of_address($address);
        return $citizen;
    }

    public function get_citizen_from_district($district_id){
        $get_address = "select a.address_id from district d 
        join commune c on d.district_id = c.district_id
        join address a on a.commune_id = c.commune_id
        where d.district_id = '$district_id'";

        $address = $this->connect->query($get_address);
        return $this->push_citizen_of_address($address);
    }

    public function get_citizen_from_commune($commune_id){
        $get_address = "select a.address_id from commune c 
        join address a on a.commune_id = c.commune_id
        where c.commune_id = '$commune_id'";

        $address = $this->connect->query($get_address);
        return $this->push_citizen_of_address($address);
    }

    public function get_citizen_from_address1($address_id){
        $citizen = $this->get_citizen_from_address($address_id);
        return $this->push_to_array($citizen);
    }

    public function insert_citizen(
        $name,
        $birth,
        $gender,
        $identifier,
        $address_id,
        $permanent_address_id,
        $temp_address_id,
        $religion,
        $education,
        $job,
        $report_id,
        $user_id
    ) {
        $query = "INSERT INTO `citizen` (`citizen_id`, `name`, `birth`, `gender`, `identifier`, `address_id`, `permanent_address_id`, 
        `temp_address_id`, `religion`, `education`, `job`, `report_id`, `user_id`) VALUES (NULL, '$name', '$birth', 
        '$gender', '$identifier', '$address_id', '$permanent_address_id', '$temp_address_id', '$religion', '$education', '$job', $report_id, $user_id)";
        return $this->connect->query($query);
    }

    public function update_citizen(
        $name,
        $birth,
        $gender,
        $identifier,
        $address_id,
        $permanent_address_id,
        $temp_address_id,
        $religion,
        $education,
        $job,
        $user_id,
        $citizen_id
    ) {
        $query = "UPDATE `citizen` SET `name` = '$name', `birth` = '$birth', `gender` = '$gender', `identifier` = '$identifier', `address_id` = '$address_id', 
        `permanent_address_id` = '$permanent_address_id', `temp_address_id` = '$temp_address_id', `religion` = '$religion', `education` = '$education', 
        `job` = '$job', `user_id` = $user_id WHERE `citizen`.`citizen_id` = $citizen_id";

        return $this->connect->query($query);
    }

    public function delete_citizen($citizen_id)
    {
        $query = "DELETE FROM `citizen` WHERE `citizen`.`citizen_id` = $citizen_id";

        return $this->connect->query($query);
    }

    private function push_citizen_of_address($address){
        $citizen = array();
        if ($address->num_rows > 0) {
            while ($row = $address->fetch_assoc()) {
                $result = $this->get_citizen_from_address($row['address_id']);
                $temp = array_udiff($this->push_to_array($result), $citizen,
                    function ($ob1, $ob2) {
                        return $ob1->citizen_id - $ob2->citizen_id;
                    }
                );
                $citizen = array_merge($citizen, $temp);
            }
        }

        return $citizen;
    }
}

$citizen = new Citizen();
$citizen->get_connect();
