<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentModel extends Model
{
    use HasFactory;

    protected $table = 'department_tbl';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'department_id',
       'department_name'
    ];

    public function employees()
    {
        return $this->hasMany(EmployeeModel::class, 'department_id');
    }
}
