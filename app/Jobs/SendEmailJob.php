<?php

namespace App\Jobs;

use App\Mail\SendEmailVerification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $url;
    protected $user;
    public function __construct($url,$user)
    {
        $this->url=$url;
        $this->user=$user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new SendEmailVerification($this->user,$this->url));
    }
}
