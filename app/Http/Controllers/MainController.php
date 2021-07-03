<?php

namespace App\Http\Controllers;

use App\Helper\Yeelight;
use App\Helper\Daikin;
use App\Models\Device;


class MainController extends Controller
{

    public function index()
    {
        // $yee = new Yeelight('192.168.0.41', 55443);
        // dd($yee);


        $devices = auth()->user()->devices()->get();

        $devices->transform(function ($item, $key) {
            switch ($item->type) {
                case 'yeelight':
                    $yee = new Yeelight($item->ip, 55443);
                    $status = $yee->get_prop("power")->commit();
                    if ($status) {
                        try {
                            $item->status = json_decode($status[0])->result[0];
                        } catch (\Throwable $th) {
                        }
                        $bright = $yee->get_prop("bright")->commit();
                        $item->bright = json_decode($bright[0])->result[0];
                        $yee->disconnect();
                    }
                    break;
                case 'daikin':
                    try {
                        $data = file_get_contents('http://' . $item->ip . '/common/basic_info');
                    } catch (\Throwable $th) {
                        $item->status = False;

                        return $item;
                    }
                    if (explode(',', $data)[6] == 'pow=0') {
                        $item->status = 'off';
                    } else if (explode(',', $data)[6] == 'pow=1') {
                        $item->status = 'on';
                    }

                    $temp = file_get_contents('http://' . $item->ip . '/aircon/get_sensor_info');

                    preg_match_all('!\d+!', explode(',', $temp)[1], $matches);
                    $item->current_temp_indoor = $matches[0][0] . '.' . $matches[0][1] . '°C';
                    preg_match_all('!\d+!', explode(',', $temp)[3], $matches);
                    $item->current_temp_outside = $matches[0][0] . '.' . $matches[0][1] . '°C';


                    // $control_info =  file_get_contents('http://' . $item->ip . '/aircon/get_control_info');

                    // $array = explode(",", $control_info);
                    // $control_info = array();
                    // foreach ($array as $value) {
                    //     $pair = explode("=", $value);
                    //     $control_info[$pair[0]] = $pair[1];
                    // }
                    // $item->data = $control_info;
            }
            return $item;
        });



        return view('home', compact('devices'));
    }

    public function lightOn($id)
    {

        $device = Device::findOrFail($id);


        switch ($device->type) {
            case 'yeelight':
                $yee = new Yeelight($device->ip, 55443);
                $yee->set_power("on");
                $yee->commit();
                $yee->disconnect();
        }

        // $yee->set_rgb(0xFF0000); // color to red
        // $yee->set_bright(50); // brightness to 50%


        // sleep(10);
        // $yee->set_rgb(0x00FF00)->set_bright(100)->commit(); // calls return the object for fast chaining of commands

        // $status = $yee->get_prop("power")->commit(); // get current status
        // print_r($status);

    }

    public function lightOff($id)
    {
        $device = Device::findOrFail($id);

        switch ($device->type) {
            case 'yeelight':
                $yee = new Yeelight($device->ip, 55443);
                $yee->set_power("off");
                $yee->commit();
                $yee->disconnect();
        }
    }

    public function luminosity($luminosity, $id)
    {
        $device = Device::findOrFail($id);

        switch ($device->type) {
            case 'yeelight':
                $yee = new Yeelight($device->ip, 55443);

                $yee->set_bright(intval($luminosity));
                $yee->commit();
                $yee->disconnect();
        }
    }

    public function clim($ip)
    {
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

        $aRequest = json_decode(file_get_contents('php://input'), true);
        $json_ret = set_array_info("/aircon/set_control_info", $ip, $aRequest);
        //request failed
        if ($json_ret === FALSE) {
            http_response_code(503); //service Unavailable
            exit;
        }
        print($json_ret);
    }

    public function color($color, $id)
    {
        $device = Device::findOrFail($id);

        switch ($device->type) {
            case 'yeelight':
                $yee = new Yeelight($device->ip, 55443);
                $yee->set_rgb(intval(request()->color));
                $yee->commit();
                $yee->disconnect();
        }
    }
}
