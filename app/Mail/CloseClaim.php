<?php

namespace App\Mail;

use App\Claim;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CloseClaim extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Claim
     */
    private $claim;

    /**
     * Create a new message instance.
     *
     * @param  Claim  $claim
     */
    public function __construct(Claim $claim)
    {
        $this->claim = $claim;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.close_claim', ['claim' => $this->claim]);
    }
}
