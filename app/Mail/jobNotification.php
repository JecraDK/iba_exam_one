<?php

namespace App\Mail;

use App\jobads;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class jobNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $job;

  /**
   * jobNotification constructor.
   * @param \App\jobads $job
   */
    public function __construct(jobads $job)
    {
        $this->job = $job;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('info@epico.dk')->subject('New job was posted!')->view('mail.jobNotification');
    }
}
