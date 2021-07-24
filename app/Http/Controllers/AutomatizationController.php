<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Device;
use App\Helper\Yeelight;
use Illuminate\Support\Facades\Http;

class AutomatizationController extends Controller
{
    public function index()
    {
        $devices = auth()->user()->devices()->get();

        $tasks = auth()->user()->tasks()->get();

        $tasks->transform(function ($item, $key) {
            $device = Device::where('id', $item->device_id)->first();
            $item->device_name = $device->name;

            return $item;
        });

        return view('add-profile', compact('devices', 'tasks'));
    }
    
    public function create()
    {
        request()->validate([
            'id' => 'string|required',
            'action' => 'string|required',
            'time_select' => 'string|required',
        ]);



        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $str = '';
        foreach ($days as $day) {
            if (request()->$day) {
                $str .= $day ;
            }
        }

        if (!$str) {
            return back()->withErrors(['no_day' => 'Aucun jour n\'a été choisit']);
        }

        $device = Device::findOrFail(request()->id);

        if ($device->type != 'yeelight' && $device->type != 'daikin') {
            return back()->withErrors(['no_support' => 'Désolé les automatisations ne sont pas encore supportées pour ce produit']);
        }

        Task::create([
            'device_id' => $device->id,
            'date' => request()->time_select,
            'action' => request()->action,
            'days' => $str,
            'user_id' => auth()->user()->id,
            'device_type' => $device->type
        ]);

        return back()->with(['success' => 'Automatisation ajoutée avec succès !']);
    }

    public function delete(Task $id)
    {
        $id->delete();
    }
}
