<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use App\Enums\JobStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    protected $connection = 'sqlite';
    protected $table = 'jobs';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'job',
        'payload',
        'status',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'id' => 'string',
            'status' => JobStatus::class,
            'payload' => AsArrayObject::class,
            'metadata' => AsArrayObject::class,
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    protected $visible = [
        'id',
        'status',
        'metadata',
        'created_at',
        'updated_at',
    ];

    public function user(): ?User
    {
        $userId = UserJob::where('job_id', $this->id)->value('user_id');

        return $userId ? User::find($userId) : null;
    }
}
