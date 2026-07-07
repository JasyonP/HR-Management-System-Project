<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobsModel extends Model
{
    use HasFactory;

    protected $table = 'jobs_tbl';

    protected $fillable = [
        'job_title',
        'salary',
        'rank_id'
     ];

    public function rank()
    {
        return $this->belongsTo(RankModel::class, 'rank_id');
    }
    
}
