<?php

namespace Danieletulone\LaravelToolkit\Helpers;

use Carbon\Carbon;
use Danieletulone\LaravelToolkit\Mail\QueueStuckMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class QueueChecker
{
    private $threshold;

    public function __construct($threshold = 3)
    {
        $this->threshold = $threshold;
    }

    public function jobs()
    {
        return DB::table('jobs');
    }

    public function countPendingJobs()
    {
        return $this->jobs()->count();
    }

    public function arePendingJobs(): bool
    {
        if ($this->countPendingJobs() > 0) {
            return true;
        }

        return false;
    }

    public function shouldAlert()
    {
        if (!self::arePendingJobs()) {
            return false;
        }

        $overPendingJobs = [];

        foreach ($this->jobs()->get() as $pendingJob) {
            if (Carbon::parse($pendingJob->created_at) < now()->subMinutes($this->threshold)) {
                $overPendingJobs[] = $pendingJob;
            }
        }

        return count($overPendingJobs) > 0;
    }

    public function sendAlert()
    {
        Mail::to(config('mail.superadmin.email'))->send(new QueueStuckMail());
    }
}
