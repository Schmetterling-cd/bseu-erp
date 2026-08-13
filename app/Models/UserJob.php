<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserJob extends Pivot
{
    protected $connection = 'sqlite';
    protected $table = 'user_jobs';
    public $timestamps = false;

    protected $fillable = ['user_id', 'job_id'];
}
