<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use App\Models\StaffModel;

class InsertRecordStaff extends Command
{
    protected $signature = 'insert:staff';
    protected $description = 'Insert a record interactively into the specified table';

    public function handle()
    {
        $tableName = with(new StaffModel())->getTable();
        $columns = Schema::getColumnListing($tableName);

        $data = [];
        foreach ($columns as $column) {
            $data[$column] = $this->ask("Enter value for column '{$column}':");
        }

        StaffModel::create($data);

        $this->info('Record inserted successfully.');
    }
}

