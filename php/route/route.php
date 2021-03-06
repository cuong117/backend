<?php

class Router
{
    public static function proc()
    {
        $ret = array();
        $fileName = "fallback";
        $controllerName = "fallback";

        // Tách URI
        $requestURI = explode('/', strtolower($_SERVER['REQUEST_URI']));
        $scriptName = explode('/', strtolower($_SERVER['SCRIPT_NAME']));
        $commandArray = array_diff_assoc($requestURI, $scriptName);
        $commandArray = array_values($commandArray);

        // POST 
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // /account
            if (strtolower($commandArray[0]) == "account") {
                

                // /account/login
                if (strtolower($commandArray[1]) == "login") {
                    $fileName = "account";
                    $controllerName = "login";
                }

                // /account/create
                if (strtolower($commandArray[1]) == "create") {
                    $fileName = "account";
                    $controllerName = "add_account";
                }

                // /account/firstLogin
                if (strtolower($commandArray[1]) == "firstlogin") {
                    $fileName = "account";
                    $controllerName = "first_login";
                }

                // /account/staff
                if (strtolower($commandArray[1]) == "staff") {
                    $fileName = "account";
                    $controllerName = "get_staff";
                }
            }

            // /citizen
            if (strtolower($commandArray[0]) == "citizen") {
                

                // /citizen/all
                if (strtolower($commandArray[1]) == "all") {
                    $fileName = 'citizen';
                    $controllerName = 'get_all_citizen';
                }

                // /citizen/add
                if (strtolower($commandArray[1]) == "add") {
                    $fileName = 'citizen';
                    $controllerName = 'add_citizen';
                }

                // /citizen/update
                if (strtolower($commandArray[1]) == "update") {
                    $fileName = 'citizen';
                    $controllerName = 'modify_citizen';
                }

                // /citizen/delete
                if (strtolower($commandArray[1]) == "delete") {
                    $fileName = 'citizen';
                    $controllerName = 'del_citizen';
                }

                // /citizen/city
                if (strtolower($commandArray[1]) == "city") {
                    $fileName = 'citizen';
                    $controllerName = 'citizen_of_city';
                }

                // /citizen/district
                if (strtolower($commandArray[1]) == "district") {
                    $fileName = 'citizen';
                    $controllerName = 'citizen_of_district';
                }

                // /citizen/commune
                if (strtolower($commandArray[1]) == "commune") {
                    $fileName = 'citizen';
                    $controllerName = 'citizen_of_commune';
                }

                // /citizen/address
                if (strtolower($commandArray[1]) == "address") {
                    $fileName = 'citizen';
                    $controllerName = 'citizen_of_address';
                }
            }

            // /report
            if (strtolower($commandArray[0]) == "report") {
                

                // /report/get
                if (strtolower($commandArray[1]) == "get") {
                    $fileName = "report";
                    $controllerName = 'get_report_of_user';
                }

                // /report/create
                if (strtolower($commandArray[1]) == "create") {
                    $fileName = "report";
                    $controllerName = 'add_report';
                }

                // /report/update
                if (strtolower($commandArray[1]) == "update") {
                    $fileName = "report";
                    $controllerName = 'modify_report';
                }

                // /report/delete
                if (strtolower($commandArray[1]) == "delete") {
                    $fileName = "report";
                    $controllerName = 'del_report';
                }

                // /report/area
                if (strtolower($commandArray[1]) == "area") {
                    $fileName = "report";
                    $controllerName = 'get_area';
                }

                // /report/complete
                if (strtolower($commandArray[1]) == "complete") {
                    $fileName = "report";
                    $controllerName = 'make_complete';
                }
            }

            // /address
            if (strtolower($commandArray[0]) == "address") {
                

                // /address/cityFromUser
                if (strtolower($commandArray[1]) == "cityfromuser") {
                    $fileName = 'address';
                    $controllerName = 'get_city_from_user';
                }

                // /address/districtFromUser
                if (strtolower($commandArray[1]) == "districtfromuser") {
                    $fileName = 'address';
                    $controllerName = 'get_district_from_user';
                }

                // /address/communeFromUser
                if (strtolower($commandArray[1]) == "communefromuser") {
                    $fileName = 'address';
                    $controllerName = 'get_commune_from_user';
                }

                // /address/addressFromUser
                if (strtolower($commandArray[1]) == "addressfromuser") {
                    $fileName = 'address';
                    $controllerName = 'get_address_from_user';
                }

                // /address/districtFromCity
                if (strtolower($commandArray[1]) == "districtfromcity") {
                    $fileName = 'address';
                    $controllerName = 'get_district_from_city';
                }

                // /address/communeFromDistrict
                if (strtolower($commandArray[1]) == "communefromdistrict") {
                    $fileName = 'address';
                    $controllerName = 'get_commune_from_district';
                }

                // /address/addressFromCommune
                if (strtolower($commandArray[1]) == "addressfromcommune") {
                    $fileName = 'address';
                    $controllerName = 'get_address_from_commune';
                }

                // /address/addcity
                if (strtolower($commandArray[1]) == "addcity") {
                    $fileName = 'address';
                    $controllerName = 'add_city';
                }

                // /address/addDistrict
                if (strtolower($commandArray[1]) == "adddistrict") {
                    $fileName = 'address';
                    $controllerName = 'add_district';
                }

                // /address/addCommune
                if (strtolower($commandArray[1]) == "addcommune") {
                    $fileName = 'address';
                    $controllerName = 'add_commune';
                }

                // /address/addAddress
                if (strtolower($commandArray[1]) == "addaddress") {
                    $fileName = 'address';
                    $controllerName = 'add_address';
                }
            }

            $ret['fileName'] = $fileName;
            $ret['controllerName'] = $controllerName;

            return $ret;
        }
    }
}
