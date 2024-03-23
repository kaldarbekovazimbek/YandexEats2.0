<?php

namespace App\Jobs;

use App\Mail\SendConfirmCodeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendConfirmCodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $email;
    protected int $confirmationCode;

    public function __construct(string $email, int $confirmationCode)
    {
        $this->email = $email;
        $this->confirmationCode = $confirmationCode;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send( new SendConfirmCodeMail($this->confirmationCode));
    }
}
