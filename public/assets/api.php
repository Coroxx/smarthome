<?php

//retrive infos encoded in php array
function get_array_info($uri, $aircon_ip)
{

    $url = "http://$aircon_ip$uri";
    $data = @file_get_contents($url);
    if ($data === FALSE) {
        return FALSE;
    } else {
        $array = explode(",", $data);
        $control_info = array();
        foreach ($array as $value) {
            $pair = explode("=", $value);
            $control_info[$pair[0]] = $pair[1];
        }
    }
    return $control_info;
}

function get_json_info($uri, $aircon_ip)
{
    $array_info = get_array_info($uri, $aircon_ip);
    if ($array_info === FALSE)
        return FALSE;
    return json_encode($array_info);
}


function set_array_info($uri, $aircon_ip, $parameters)
{
    $url = "http://$aircon_ip$uri";
    $context = stream_context_create(NULL, $parameters);
    $data = file_get_contents($url . '?' . http_build_query($parameters));
    if ($data === FALSE) {
        return FALSE;
    } else {
        $array = explode(",", $data);
        $control_info = array();
        foreach ($array as $value) {
            $pair = explode("=", $value);
            $control_info[$pair[0]] = $pair[1];
        }
        return json_encode($control_info);
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aRequest = json_decode(file_get_contents('php://input'), true);
    die($aRequest);
    $json_ret = set_array_info("/aircon/set_control_info", $ip, $aRequest);
    //request failed
    if ($json_ret === FALSE) {
        http_response_code(503); //service Unavailable
        exit;
    }
    print($json_ret);
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //control if uri is sended
    if ((!isset($_GET["uri"])) || ($_GET["uri"] != "/aircon/get_sensor_info" &&
        $_GET["uri"] != "/aircon/get_control_info")) {
        http_response_code(405); //method not allowed
        exit;
    }

    $json_info = get_json_info($_GET["uri"], $ip);
    //request failed
    if ($json_info === FALSE) {
        http_response_code(503); //service Unavailable
        exit;
    }
    print($json_info);
}
