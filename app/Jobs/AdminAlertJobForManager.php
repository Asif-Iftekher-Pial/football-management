<?php

namespace App\Jobs;

use App\Mail\AdminAlertForManagerMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class AdminAlertJobForManager implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $manager;
    protected $club;
    protected $admin;
    public function __construct($manager,$club,$admin)
    {
        $this->manager = $manager;
        $this->club = $club;
        $this->admin = $admin;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->admin->email)->send(new AdminAlertForManagerMail($this->club,$this->manager));
    }
}
