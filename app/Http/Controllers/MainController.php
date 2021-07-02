<?php

namespace App\Http\Controllers;

use App\Helper\Yeelight;
use App\Models\Device;


class MainController extends Controller
{
    public function index()
    {
        $devices = auth()->user()->devices()->get();

        return view('home', compact('devices'));
    }

    public function lightOn($id)
    {

        $device = Device::query()->findOrFail($id);


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
        $device = Device::query()->findOrFail($id);

        switch ($device->type) {
            case 'yeelight':
                $yee = new Yeelight($device->ip, 55443);
                $yee->set_power("off");
                $yee->commit();
                $yee->disconnect();
        }
    }
}
