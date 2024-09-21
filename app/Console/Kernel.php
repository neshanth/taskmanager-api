<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){
            $users = DB::table("users")->where("email","=","demouser@demo.com")->get();
            $userId = $users[0]->id;
            $tasks = DB::table("tasks")->where("user_id","=", $userId)->get();
            if(count($tasks) > 0){
                DB::table("tasks")->where("user_id","=",$userId)->delete();
                $tasks = [
                    [
                        'description' => 'Review project plan and finalize the details',
                        'due_date' => now()->addDays(2)->toDateString(),
                        'status' => 0,
                        'task' => 'Project Review',
                        'user_id' => $userId
                    ],
                    [
                        'description' => 'Complete the database migration script',
                        'due_date' => now()->addDays(4)->toDateString(),
                        'status' => 0,
                        'task' => 'Database Migration',
                        'user_id' => $userId
                    ],
                    [
                        'description' => 'Go grocery shopping for the week',
                        'due_date' => now()->addDays(1)->toDateString(),
                        'status' => 0,
                        'task' => 'Grocery Shopping',
                        'user_id' => $userId
                    ],
                    [
                        'description' => 'Prepare presentation for client meeting',
                        'due_date' => now()->addDays(3)->toDateString(),
                        'status' => 0,
                        'task' => 'Client Presentation',
                        'user_id' => $userId
                    ],
                    [
                        'description' => 'Attend yoga class',
                        'due_date' => now()->addDays(2)->toDateString(),
                        'status' => 0,
                        'task' => 'Yoga Session',
                        'user_id' => $userId
                    ],
                    [
                        'description' => 'Respond to pending emails',
                        'due_date' => now()->addDays(1)->toDateString(),
                        'status' => 0,
                        'task' => 'Email Follow-up',
                        'user_id' => $userId
                    ],
                    [
                        'description' => 'Book flight tickets for vacation',
                        'due_date' => now()->addDays(7)->toDateString(),
                        'status' => 0,
                        'task' => 'Book Flight Tickets',
                        'user_id' => $userId
                    ],
                    [
                        'description' => 'Fix bug in user login system',
                        'due_date' => now()->addDays(2)->toDateString(),
                        'status' => 0,
                        'task' => 'Bug Fix: User Login',
                        'user_id' => $userId
                    ],
                    [
                        'description' => 'Schedule team stand-up meeting',
                        'due_date' => now()->addDays(1)->toDateString(),
                        'status' => 0,
                        'task' => 'Team Stand-up',
                        'user_id' => $userId
                    ],
                    [
                        'description' => 'Buy birthday gift for friend',
                        'due_date' => now()->addDays(5)->toDateString(),
                        'status' => 0,
                        'task' => 'Friend\'s Birthday Gift',
                        'user_id' => $userId
                    ],
                    [
                        'description' => 'Plan weekend getaway',
                        'due_date' => now()->addDays(6)->toDateString(),
                        'status' => 0,
                        'task' => 'Weekend Getaway',
                        'user_id' => $userId
                    ],
                    [
                        'description' => 'Design homepage layout',
                        'due_date' => now()->addDays(3)->toDateString(),
                        'status' => 0,
                        'task' => 'Homepage Design',
                        'user_id' => $userId
                    ],
                    [
                        'description' => 'Complete quarterly budget review',
                        'due_date' => now()->addDays(2)->toDateString(),
                        'status' => 0,
                        'task' => 'Budget Review',
                        'user_id' => $userId
                    ],
                    [
                        'description' => 'Call plumber for kitchen sink repair',
                        'due_date' => now()->addDays(4)->toDateString(),
                        'status' => 0,
                        'task' => 'Call Plumber',
                        'user_id' => $userId
                    ],
                    [
                        'description' => 'Watch the new movie release',
                        'due_date' => now()->addDays(3)->toDateString(),
                        'status' => 0,
                        'task' => 'Movie Night',
                        'user_id' => $userId
                    ]
                ];
                DB::table('tasks')->insert($tasks);
            }
        })->daily();
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
