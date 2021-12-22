<?php

require_once("database/database.php");

class Address extends Database
{

    public function get_city_of_user($user_id)
    {
        $type = $this->type_of_user($user_id);
        $get_city = "";
        if ($type == "A1") {
            $get_city = "SELECT * FROM `city`";
        } elseif ($type == "A2") {
            $get_city = "SELECT c.city_id, c.name FROM user_a2 u
             join city c on u.city_id = c.city_id
             where u.user_id = $user_id";
        }
        if ($get_city != "") {
            $result = $this->connect->query($get_city);
            return $this->push_to_array($result);
        }
        return "No data";
    }

    public function get_district_of_user($user_id)
    {
        $get_district = "SELECT d.district_id, d.name FROM user_a3 u
        join district d on u.district_id = d.district_id
        where u.user_id = $user_id";

        $result = $this->connect->query($get_district);
        return $this->push_to_array($result);
    }

    public function get_commune_of_user($user_id)
    {
        $get_commune = "SELECT c.commune_id, c.name FROM user_b1 u
        join commune c on u.commune_id = c.commune_id
        where u.user_id = $user_id";

        $result = $this->connect->query($get_commune);
        return $this->push_to_array($result);
    }

    public function get_address_of_user($user_id)
    {
        $get_address = "SELECT a.address_id, a.name FROM user_b2 u
        join address a on u.address_id = a.address_id
        where u.user_id = $user_id";

        $result = $this->connect->query($get_address);
        return $this->push_to_array($result);
    }

    public function get_district_of_city($city_id)
    {
        $get_district = "SELECT d.district_id, d.name FROM district d WHERE d.city_id = $city_id";

        $result = $this->connect->query($get_district);
        return $this->push_to_array($result);
    }

    public function get_commune_of_district($district_id)
    {
        $get_commune = "SELECT c.commune_id, c.name from commune c WHERE c.district_id = $district_id";

        $result = $this->connect->query($get_commune);
        return $this->push_to_array($result);
    }

    public function get_address_of_commune($commune_id)
    {
        $get_address = "SELECT a.address_id, a.name from address a WHERE a.commune_id = $commune_id";

        $result = $this->connect->query($get_address);
        return $this->push_to_array($result);
    }
}

$address = new Address();
$address->get_connect();
