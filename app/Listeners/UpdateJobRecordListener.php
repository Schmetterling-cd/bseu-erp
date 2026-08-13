<?php

namespace App\Listeners;

use App\Models\Job;
use App\Enums\JobStatus;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Queue\Events\JobQueued;

class UpdateJobRecordListener
{
    public function handle(
        JobQueued|JobProcessing|JobProcessed|JobFailed $event
    ): void {
        if (!($jobId = $this->getJobId($event))) {
            return;
        }

        /** @var Job $jobRecord */
        $jobRecord = Job::findOrNew($jobId);

        $jobRecord->job = $this->getJobClass($event);
        $jobRecord->status = $this->getJobStatus($event);
        $jobRecord->payload = $this->getJobPayload($event);
        $jobRecord->metadata = $event instanceof JobFailed
            ? [
                'error' => $event->exception->getMessage(),
                'trace' => $event->exception->getTraceAsString()
            ]
            : []
        ;

        if ($jobRecord->isDirty()) {
            $jobRecord->save();
        }
    }

    private function getJobId(object $event): ?string
    {
        return method_exists($event->job, 'getJobId')
            ? $event->job->getJobId()
            : null
        ;
    }

    private function getJobClass(object $event): ?string
    {
        $payload = $event->job->payload();

        if (isset($payload['data']['command'])) {
            $command = unserialize($payload['data']['command']);
            return get_class($command);
        }

        return null;
    }

    private function getJobStatus(
        JobQueued|JobProcessing|JobProcessed|JobFailed $event
    ): JobStatus {
        return match (true) {
            $event instanceof JobQueued => JobStatus::PENDING,
            $event instanceof JobProcessing => JobStatus::RUNNING,
            $event instanceof JobProcessed => JobStatus::COMPLETED,
            $event instanceof JobFailed => JobStatus::FAILED,
        };
    }

    private function getJobPayload(object $event): array
    {
        $payload = $event->job->payload();

        if (!isset($payload['data']['command'])) {
            return [];
        }

        $command = unserialize($payload['data']['command']);

        return get_object_vars($command);
    }
}
