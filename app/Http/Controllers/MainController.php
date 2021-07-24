<?php

namespace App\Http\Controllers;

use App\Helper\Yeelight;
use App\Helper\Daikin;
use App\Models\Device;
use Illuminate\Support\Facades\Http;

class MainController extends Controller
{
    public function index()
    {
        $devices = auth()->user()->devices()->get();

        $devices->transform(function ($item, $key) {
            switch ($item->type) {
                case 'yeelight':
                    $yee = new Yeelight($item->ip, 55443);
                    $status = $yee->get_prop("power")->commit();
                    if ($status) {
                        try {
                            $item->status = json_decode($status[0])->result[0];


                            $bright = $yee->get_prop("bright")->commit();
                            $item->bright = json_decode($bright[0])->result[0];
                            $yee->disconnect();
                        } catch (\Throwable $th) {
                        }
                    }
                    break;
                case 'daikin':
                    try {
                        $data = file_get_contents('http://' . $item->ip . '/common/basic_info');
                    } catch (\Throwable $th) {
                        $item->status = false;

                        return $item;
                    }
                    if (explode(',', $data)[6] == 'pow=0') {
                        $item->status = 'off';
                    } elseif (explode(',', $data)[6] == 'pow=1') {
                        $item->status = 'on';
                    }

                    $temp = file_get_contents('http://' . $item->ip . '/aircon/get_sensor_info');

                    preg_match_all('!\d+!', explode(',', $temp)[1], $matches);
                    $item->current_temp_indoor = $matches[0][0] . '.' . $matches[0][1] . '°C';
                    preg_match_all('!\d+!', explode(',', $temp)[3], $matches);
                    $item->current_temp_outside = $matches[0][0] . '.' . $matches[0][1] . '°C';

                    $settings = file_get_contents('http://' . $item->ip . '/aircon/get_control_info');
                    preg_match_all('!\d+!', explode(',', $settings)[4], $matches);
                    $item->current_target_temp = $matches[0][0] . '.' . $matches[0][1];

                    break;
                case 'foscam':
                    try {
                        Http::timeout(3)->get($item->ip);
                        $item->status = 'online';
                    } catch (\Throwable $th) {
                    }
                    break;
            }
            return $item;
        });



        return view('home', compact('devices'));
    }

    public function lightOn(Device $device)
    {
        switch ($device->type) {
            case 'yeelight':
                $yee = new Yeelight($device->ip, 55443);
                $yee->set_power("on");
                $yee->commit();
                $yee->disconnect();
        }
    }

    public function lightOff(Device $device)
    {
        switch ($device->type) {
            case 'yeelight':
                $yee = new Yeelight($device->ip, 55443);
                $yee->set_power("off");
                $yee->commit();
                $yee->disconnect();
        }
    }

    public function luminosity($luminosity, Device $device)
    {
        switch ($device->type) {
            case 'yeelight':
                $yee = new Yeelight($device->ip, 55443);

                $yee->set_bright(intval($luminosity));
                $yee->commit();
                $yee->disconnect();
        }
    }


    public function color($color, Device $device)
    {
        switch ($device->type) {
            case 'yeelight':
                $yee = new Yeelight($device->ip, 55443);
                $yee->set_rgb(intval(request()->color));
                $yee->commit();
                $yee->disconnect();
        }
    }

    public function deleteDevice(Device $device)
    {
        $device->delete();

        return redirect()->route('home');
    }

    public function createDevice()
    {
        request()->validate(
            [
                'type' => 'required|string',
                'name' => 'string|required|max:25|min:3',
                'ip' => 'regex:^[0-9.:]*$^|string',
                'username' => 'string|nullable',
                'password' => 'string|nullable'
            ],
            [
                'type.required' => 'Vous devez sélectionner un type d\'appareil',
                'name.max' => 'Le nom ne peut pas dépasser les 25 caractères',
                'name.min' => 'Le nom doit faire au moins 3 caractères',
            ]
        );


        Device::create([
            'name' => request()->name,
            'ip' => request()->ip,
            'type' => request()->type,
            'user_id' => auth()->user()->id,
            'username' => request()->username,
            'password' => request()->password
        ]);

        return redirect()->route('home');
    }
}
