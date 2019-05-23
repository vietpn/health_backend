<?php

namespace App\Jobs;

use App\Events\MessageSent;
use App\Models\Message;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class sentMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $userSent;
    public $usserRecive;
    /**
     * Message details
     *
     * @var Message
     */
    public $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $userSent, User $usserRecive, Message $message)
    {
        $this->userSent = $userSent;
        $this->usserRecive = $usserRecive;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        broadcast(new MessageSent($this->userSent, $this->usserRecive, $this->message))->toOthers();
    }
}
