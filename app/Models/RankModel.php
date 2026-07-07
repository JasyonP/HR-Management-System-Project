<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankModel extends Model
{
    use HasFactory;

    protected $table = 'rank_tbl';

    protected $fillable = [
        'rank_level'
    ];
}
