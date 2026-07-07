<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('address');
            $table->string('phone_number');
            $table->string('email');
            $table->string('work_status');
            $table->string('employment_status');
            $table->string('profile')->nullable();
            $table->foreignId('job_id')->references('id')->on('jobs_tbl')->onDelete('cascade');
            $table->foreignId('department_id')->references('id')->on('department_tbl')->onDelete('cascade');
            $table->foreignId('staff_id')->references('id')->on('staff_tbl')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_tbl');
    }
};
