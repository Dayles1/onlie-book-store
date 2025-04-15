<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\SendEmailVerification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailJob implements ShouldQueue
{
    use Queueable;
    
    
    
    /**pr
     * Create a new job instance.
     */
    public function __construct(protected $user, protected $url)
    {
        $this->user = $user;

        $this->url=$url;
       
        
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
    Mail::to($this->user->email)->send(new SendEmailVerification($this->user,$this->url));
    }
}