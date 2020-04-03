<?php

namespace App\Mail;

use App\Claim;
use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewClaim extends Mailable
{
    use Queueable, SerializesModels;

    private $claim;

    private $message;

    /**
     * Create a new message instance.
     *
     * @param  Claim  $claim
     * @param  Message  $message
     */
    public function __construct(Claim $claim, Message $message)
    {
        $this->claim = $claim;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.new_claim', [
            'claim' => $this->claim,
            'claimMessage' => $this->message
        ]);
    }
}
