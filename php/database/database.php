<?php
const host = '192.168.1.28';
const user = 'root';
const pass = '19020238';
const database = 'web_population';

class Database{
    protected $connect;

    public function get_connect(){
        $this->connect = mysqli_connect(host, user, pass, database);
        if ($this->connect->connect_error) {
            die("Connection failed: " . $this->connect->connect_error);
        }
    }

    public function type_of_user($user_id){
        $query = "SELECT type from user WHERE user_id = $user_id";
        $result = $this->connect->query($query);
        if($result -> num_rows > 0){
            $row = $result -> fetch_assoc();
            return $row["type"];
        }

        return false;
    }

    protected function get_citizen_from_address($address_id){
        $query = "SELECT c.citizen_id, c.name, c.birth, c.gender, c.identifier, get_address_name_from_id(c.address_id) address_name, 
        get_address_name_from_id(c.permanent_address_id) permanent_address_name, 
        get_address_name_from_id(c.temp_address_id) temp_address_name, c.religion, c.education, c.job 
        from citizen c WHERE c.address_id = '".$address_id."' or c.permanent_address_id = '".$address_id."' or c.temp_address_id = '".$address_id."'";
        
        return $this->connect->query($query);
    }

    protected function push_to_array($result){
        // $ob = new stdClass();
        // foreach($array as $key => $value){
        //     $ob -> $key = $value;
        // }
        $array = array();
        if($result -> num_rows > 0){
            while($row = $result -> fetch_assoc()){
                $ob = new stdClass();
                foreach($row as $key => $value){
                    $ob -> $key = $value;
                }
                array_push($array, $ob);
            }
        }
        return $array;
    }

    protected function get_sub_type($type){
        if($type == "A1"){
            return "A2";
        }elseif($type == "A2"){
            return "A3";
        }elseif($type == "A3"){
            return "B1";
        }elseif($type == "B1"){
            return "B2";
        }

        return "non-type";
    }
}
// $data = new Database();
// $data -> get_connect();
// echo $data -> type_of_user(1);