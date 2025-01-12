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
                        'description' => 'Review the current project to ensure everything is on track. Check each team member’s progress and address any issues. Send a summary email with action items for the team.',
                        'due_date' => now()->toDateString(),
                        'status' => 0,
                        'task' => 'Project Status Review and Action Plan',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Finalize the designs for the new feature. Make sure all feedback from the client is incorporated and ensure the designs are fully responsive. Prepare the design files for handoff to development.',
                        'due_date' => now()->addDays(1)->toDateString(),
                        'status' => 0,
                        'task' => 'Finalize and Handoff New Feature Designs for chat application',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Test the latest release for any bugs or performance issues. Focus on critical areas like the payment gateway and dashboard functionalities. Report any bugs or improvements to the development team.',
                        'due_date' => now()->toDateString(),
                        'status' => 1, // Completed task
                        'task' => 'Conduct Release Testing and Report Issues',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Prepare the presentation for the upcoming meeting. Focus on key project milestones and future goals. Ensure all visual elements are clear and aligned with the project timeline.',
                        'due_date' => now()->addDays(2)->toDateString(),
                        'status' => 0,
                        'task' => 'Create Presentation for Upcoming Meeting with sales team',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Organize a catch-up meeting with the marketing team. Review the ongoing campaigns and discuss improvements for the next quarter. Ensure the team is aligned with the new goals.',
                        'due_date' => now()->addDays(3)->toDateString(),
                        'status' => 0,
                        'task' => 'Marketing Team Meeting for Campaign Review at Residency Towers',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Handle customer support tickets. Prioritize urgent issues and provide solutions in a timely manner. Keep track of all support cases and ensure that each one is resolved.',
                        'due_date' => now()->toDateString(),
                        'status' => 1, // Completed task
                        'task' => 'Manage and Resolve Customer Support Tickets by 5pm',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Start the process of gathering data for the upcoming report. Collect information from all departments and ensure that the data is accurate. Organize everything to prepare for analysis.',
                        'due_date' => now()->addDays(4)->toDateString(),
                        'status' => 0,
                        'task' => 'Gather Sales Data for Monthly Report by 4:30 PM',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Review the codebase for any outdated or deprecated functions. Replace them with more efficient solutions and run tests to make sure nothing breaks. Document the changes made for the team.',
                        'due_date' => now()->addDays(5)->toDateString(),
                        'status' => 0,
                        'task' => 'Refactor Codebase for Deprecated Jquery Functions',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Prepare for the next team-building event. Research activity ideas, gather quotes, and plan logistics. Make sure to coordinate with the event organizer to ensure everything is set up.',
                        'due_date' => now()->addDays(6)->toDateString(),
                        'status' => 0,
                        'task' => 'Organize Team-Building Event at Taj Hotel',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Complete the UI design for the new dashboard. Focus on user experience and make sure the design is clean and intuitive. Finalize the design elements for development handoff.',
                        'due_date' => now()->addDays(7)->toDateString(),
                        'status' => 0,
                        'task' => 'Design UI for New E-commerce Dashboard',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Review the current marketing strategies and assess their effectiveness. Suggest improvements and propose new ideas to enhance visibility. Ensure alignment with the business goals.',
                        'due_date' => now()->addDays(1)->toDateString(),
                        'status' => 0,
                        'task' => 'Evaluate and Improve Marketing Strategies',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Prepare the office for an important client meeting. Tidy up the workspace, ensure all documents and equipment are ready, and set up a presentation area.',
                        'due_date' => now()->toDateString(),
                        'status' => 1, // Completed task
                        'task' => 'Office Preparation for Client Meeting',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => 'Complete reading the industry-related book for continuous learning. Take notes on valuable insights and implement them in your current workflow to improve productivity.',
                        'due_date' => now()->addDays(8)->toDateString(),
                        'status' => 0,
                        'task' => 'Finish Reading Industry-Related Book',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    // Personal Task 1
                    [
                        'description' => 'Go to the airline website and book tickets for a vacation to Europe. Ensure that everything is in order and that there are enough seats available.',
                        'due_date' => now()->toDateString(),
                        'status' => 0,
                        'task' => 'Book Flight Tickets for Vacation',
                        'user_id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    // Personal Task 2
                    [
                        'description' => 'Plan a workout routine for the week and stick to it. Include exercises targeting different muscle groups and ensure to include rest days. Make time each day to complete the workout.',
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
