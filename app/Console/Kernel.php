<?php

namespace App\Console;

use  App\Models\Task;
use  App\Models\User;
use App\Models\Device;
use Illuminate\Support\Facades\Http;
use App\Helper\Yeelight;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */


    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $tasks = Task::where('date', date('H:i'))->get();

            if ($tasks) {
                foreach ($tasks as $task) {
                    if (User::find($task->user_id)->vacation == 1) {
                        return;
                    }
                    if (!stristr($task->days, date('l'))) {
                        continue;
                    }
                    $device = Device::findOrFail($task->device_id);
                    switch ($task->device_type) {
                        case 'daikin':

                            function parse($string)
                            {
                                $data = explode(",", $string->body());
                                $control_info = [];
                                foreach ($data as $val) {
                                    $pair = explode("=", $val);
                                    $control_info[$pair[0]] = $pair[1];
                                }

                                return $control_info;
                            }

                            $response = Http::get('http://' . $device->ip . '/aircon/get_control_info');
                            $control_info = parse($response);

                            if ($task->action == '1') {
                                $control_info['pow'] = 1;
                            } else {
                                $control_info['pow'] = 0;
                            }
                            Http::get('http://' . $device->ip . '/aircon/set_control_info', $control_info);
                            break;
                        case 'yeelight':


                            $yee = new Yeelight($device->ip, 55443);

                            if ($task->action == '1') {
                                $yee->set_power("on");
                            } else {
                                $yee->set_power("off");
                            }
                            $yee->commit();
                            $yee->disconnect();

                            break;
                    }
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
