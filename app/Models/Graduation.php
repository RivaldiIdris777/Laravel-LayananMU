<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduation extends Model
{
    use HasFactory;

    protected $table = 'graduation';

    protected $fillable = [
        'name',
        'npm',
        'major',
        'year',
        'status_job',
        'status_major_now',
        'photo',
    ];
}
