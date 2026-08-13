<?php

namespace App\Interfaces;

use App\Enums\JobStatus;
use Illuminate\Contracts\Queue\ShouldQueue;

interface JobInterface
{
    public function startJob(string $jobClass, array $payload): void;
    public function getJobStatus(string $jobId): JobStatus;
}
