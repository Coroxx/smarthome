<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Support\Facades\Http;

class DaikinController extends Controller
{
    private function parse($string)
    {
        $data = explode(",", $string->body());
        $control_info = [];
        foreach ($data as $val) {
            $pair = explode("=", $val);
            $control_info[$pair[0]] = $pair[1];
        }

        return $control_info;
    }


    public function togglePower(Device $device)
    {
        $response = Http::get('http://' . $device->ip . '/aircon/get_control_info');

        $control_info = $this->parse($response);
        $control_info['pow'] = $control_info['pow'] == 1 ? 0 : 1;

        Http::get('http://' . $device->ip . '/aircon/set_control_info', $control_info);
    }

    public function targetTemp(Device $device, $temp)
    {
        request()->validate([
            $temp => 'regex:\d+[\.]?\d+',
        ]);

        if (intval($temp) > 30) {
            return abort(403);
        } else if (intval($temp) < 25) {
            return abort(403);
        }



        $response = Http::get('http://' . $device->ip . '/aircon/get_control_info');
        $control_info = $this->parse($response);

        $control_info['stemp'] = $temp;

        Http::get('http://' . $device->ip . '/aircon/set_control_info', $control_info);
    }
}
