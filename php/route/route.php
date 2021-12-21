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

        if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "GET") {
            // /account
            if (strtolower($commandArray[0]) == "account") {
                $fileName = "account";

                // /account/login
                if (strtolower($commandArray[1]) == "login") {
                    $controllerName = "login";
                }

                // /account/create
                if (strtolower($commandArray[1]) == "create") {
                    $controllerName = "add_account";
                }

                // /account/firstLogin
                if (strtolower($commandArray[1]) == "firstlogin") {
                    $controllerName = "first_login";
                }

                // /account/staff
                if (strtolower($commandArray[1]) == "staff") {
                    $controllerName = "get_staff";
                }
            }

            // /citizen
            if (strtolower($commandArray[0]) == "citizen") {
                $fileName = 'citizen';

                // /citizen/all
                if (strtolower($commandArray[1]) == "all") {
                    $controllerName = 'get_all_citizen';
                }

                // /citizen/add
                if (strtolower($commandArray[1]) == "add") {
                    $controllerName = 'add_citizen';
                }

                // /citizen/update
                if (strtolower($commandArray[1]) == "update") {
                    $controllerName = 'modify_citizen';
                }

                // /citizen/delete
                if (strtolower($commandArray[1]) == "delete") {
                    $controllerName = 'del_citizen';
                }
            }

            // /report
            if (strtolower($commandArray[0]) == "report") {
                $fileName = "report";

                // /report/get
                if (strtolower($commandArray[1]) == "get") {
                    $controllerName = 'get_report_of_user';
                }

                // /report/create
                if (strtolower($commandArray[1]) == "create") {
                    $controllerName = 'add_report';
                }

                // /report/update
                if (strtolower($commandArray[1]) == "update") {
                    $controllerName = 'modify_report';
                }

                // /report/delete
                if (strtolower($commandArray[1]) == "delete") {
                    $controllerName = 'del_report';
                }
            }

            // /address
            if (strtolower($commandArray[0]) == "address") {
                $fileName = 'address';

                // /address/cityFromUser
                if (strtolower($commandArray[1]) == "cityfromuser") {
                    $controllerName = 'get_city_from_user';
                }

                // /address/districtFromUser
                if (strtolower($commandArray[1]) == "districtfromuser") {
                    $controllerName = 'get_district_from_user';
                }

                // /address/communeFromUser
                if (strtolower($commandArray[1]) == "communefromuser") {
                    $controllerName = 'get_commune_from_user';
                }

                // /address/addressFromUser
                if (strtolower($commandArray[1]) == "addressfromuser") {
                    $controllerName = 'get_address_from_user';
                }

                // /address/districtFromCity
                if (strtolower($commandArray[1]) == "districtfromcity") {
                    $controllerName = 'get_district_from_city';
                }

                // /address/communeFromDistrict
                if (strtolower($commandArray[1]) == "communefromdistrict") {
                    $controllerName = 'get_commune_from_district';
                }

                // /address/addressFromCommune
                if (strtolower($commandArray[1]) == "addressfromcommune") {
                    $controllerName = 'get_address_from_commune';
                }
            }

            $ret['fileName'] = $fileName;
            $ret['controllerName'] = $controllerName;

            return $ret;
        }
    }
}
