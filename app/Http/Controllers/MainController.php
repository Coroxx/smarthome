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
                        $item->status = json_decode($status[0])->result[0];
                        $bright = $yee->get_prop("bright")->commit();
                        $item->bright = json_decode($bright[0])->result[0];
                        $yee->disconnect();
                    }
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
