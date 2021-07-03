<?php

namespace app\Helper;




class Daikin
{

    //retrive infos encoded in php array
    // function get_array_info($uri, $aircon_ip)
    // {

    //     $url = "http://$aircon_ip$uri";
    //     $data = @file_get_contents($url);
    //     if ($data === FALSE) {
    //         return FALSE;
    //     } else {
    //         $array = explode(",", $data);
    //         $control_info = array();
    //         foreach ($array as $value) {
    //             $pair = explode("=", $value);
    //             $control_info[$pair[0]] = $pair[1];
    //         }
    //     }
    //     return $control_info;
    // }

    // //retrive infos encoded in JSON format
    // function get_json_info($uri, $aircon_ip)
    // {
    //     $array_info = get_array_info($uri, $aircon_ip);
    //     if ($array_info === FALSE)
    //         return FALSE;
    //     return json_encode($array_info);
    // }


    // function set_array_info($uri, $aircon_ip, $parameters)
    // {
    //     $url = "http://$aircon_ip$uri";
    //     $context = stream_context_create(NULL, $parameters);
    //     $data = file_get_contents($url . '?' . http_build_query($parameters));
    //     if ($data === FALSE) {
    //         return FALSE;
    //     } else {
    //         $array = explode(",", $data);
    //         $control_info = array();
    //         foreach ($array as $value) {
    //             $pair = explode("=", $value);
    //             $control_info[$pair[0]] = $pair[1];
    //         }
    //         return json_encode($control_info);
    //     }
    // }

    public function __construct($ip, $port)
    {
        $this->ip = $ip;
        $this->port = $port;
        if (!$this->verifyConnection()) return false;
    }

    private function verifyConnection()
    {
        try {
            $this->fp = fsockopen($this->ip, $this->port, $this->errno, $this->errstr, 10);
        } catch (\Throwable $th) {
            return false;
        }

        // if (!$this->fp) return false;

        stream_set_blocking($this->fp, false);
        return true;
    }
}
