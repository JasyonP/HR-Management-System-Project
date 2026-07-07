<?php

namespace App\Console\Commands;

use App\Models\RankModel;
use App\Models\StaffModel;
use Illuminate\Console\Command;

class StoreStaffCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:staff';

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
}
}
