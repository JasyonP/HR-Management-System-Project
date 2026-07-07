<?php

namespace App\Console\Commands;

use App\Models\DepartmentModel;
use App\Models\JobsModel;
use App\Models\RankModel;
use App\Models\StaffModel;
use Illuminate\Console\Command;

class StoreDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $manager = [
            ['username' => 'jayson', 'password' => 'pascual', 'first_name' => 'Jayson', 'last_name' => 'Pascual', 'gender' => 'Male', 'title' => 'MANAGER'],
            ['username' => 'christian', 'password' => 'juico', 'first_name' => 'Christian', 'last_name' => 'Juico', 'gender' => 'Male', 'title' => 'MANAGER'],
            // Add more rows as needed
        ];
    
        foreach ($manager as $manag) {
           StaffModel::create($manag); // Replace YourModel with your actual model
        }

    
    $ranks = [
        ['rank_level' => '1'],
        ['rank_level' => '2'],
        ['rank_level' => '3'],
        ['rank_level' => '4'],
        ['rank_level' => '5'],
        
        // Add more rows as needed
    ];

    foreach ($ranks as $rank) {
       RankModel::create($rank); // Replace YourModel with your actual model
    }
    
        // $jobs = [
        //     ['job_title' => 'Dean', 'salary' => '40k', 'rank_id'=> '1'],
        //     ['job_title' => 'Staff', 'salary' => '40k', 'rank_id'=> '2'],
        //     ['job_title' => 'ITSO', 'salary' => '40k', 'rank_id'=> '3'],
        //     ['job_title' => 'Faculty', 'salary' => '40k', 'rank_id'=> '4'],
        //     ['job_title' => 'Professor', 'salary' => '40k', 'rank_id'=> '5'],
            
        //     // Add more rows as needed
        // ];

        // foreach ($jobs as $job) {
        //    JobsModel::create($job); // Replace YourModel with your actual model
        // }
    
    
    $deparments = [
        ['department_name' => 'CCS'],
        ['department_name' => 'CBA'],
        ['department_name' => 'CON'],
        ['department_name' => 'COE'],
        ['department_name' => 'COA'],
        
        // Add more rows as needed
    ];

    foreach ($deparments as $dept) {
       DepartmentModel::create($dept); // Replace YourModel with your actual model
    }
}   

}