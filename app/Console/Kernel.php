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
                DB::table("tasks")->where("user_id","=",$userId)->delete();
                $tasks = [
                    [
                        'description' => 'Review the project progress, address team issues, and send a summary email with action items.',
                        'due_date' => now()->toDateString(),
                        'status' => 0,
                        'task' => 'Project Status Review and Action Plan',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Finalize designs for a new feature, incorporate client feedback, and prepare files for handoff.',
                        'due_date' => now()->addDays(1)->toDateString(),
                        'status' => 0,
                        'task' => 'Finalize and Handoff New Feature Designs',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Test the latest release for bugs and report issues focusing on critical areas like payment gateway.',
                        'due_date' => now()->toDateString(),
                        'status' => 1,
                        'task' => 'Conduct Release Testing and Report Issues',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Prepare a meeting presentation highlighting key milestones and future goals with clear visuals.',
                        'due_date' => now()->addDays(2)->toDateString(),
                        'status' => 0,
                        'task' => 'Create Presentation for Upcoming Meeting',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Organize a meeting to review marketing campaigns, discuss improvements, and align team goals.',
                        'due_date' => now()->addDays(3)->toDateString(),
                        'status' => 0,
                        'task' => 'Marketing Team Meeting for Campaign Review',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Handle customer support tickets, prioritize urgent issues, and ensure timely resolution.',
                        'due_date' => now()->toDateString(),
                        'status' => 1,
                        'task' => 'Manage and Resolve Customer Support Tickets',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Start gathering accurate data for the report by collecting information from all departments.',
                        'due_date' => now()->addDays(4)->toDateString(),
                        'status' => 0,
                        'task' => 'Gather Sales Data for Monthly Report',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Review the codebase to replace deprecated functions, test thoroughly, and document updates.',
                        'due_date' => now()->addDays(5)->toDateString(),
                        'status' => 0,
                        'task' => 'Refactor Codebase for Deprecated Functions',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Plan a team-building event by researching activities, gathering quotes, and coordinating logistics.',
                        'due_date' => now()->addDays(6)->toDateString(),
                        'status' => 0,
                        'task' => 'Organize Team-Building Event',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Complete UI design for the dashboard focusing on user experience and clean, intuitive layouts.',
                        'due_date' => now()->addDays(7)->toDateString(),
                        'status' => 0,
                        'task' => 'Design UI for New Dashboard',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Evaluate current marketing strategies, suggest improvements, and align with business goals.',
                        'due_date' => now()->addDays(1)->toDateString(),
                        'status' => 0,
                        'task' => 'Evaluate and Improve Marketing Strategies',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Prepare the workspace for a client meeting with tidy spaces and necessary equipment.',
                        'due_date' => now()->toDateString(),
                        'status' => 1,
                        'task' => 'Office Preparation for Client Meeting',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Complete reading an industry-related book and implement key insights in workflows.',
                        'due_date' => now()->addDays(8)->toDateString(),
                        'status' => 0,
                        'task' => 'Finish Reading Industry-Related Book',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Book flight tickets for a vacation to Europe, ensuring availability and completing payment.',
                        'due_date' => now()->toDateString(),
                        'status' => 0,
                        'task' => 'Book Flight Tickets for Vacation',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Plan and follow a weekly workout schedule targeting all muscle groups with rest days.',
                        'due_date' => now()->toDateString(),
                        'status' => 0,
                        'task' => 'Create and Follow Weekly Workout Plan',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ];
                DB::table('tasks')->insert($tasks);
            
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
