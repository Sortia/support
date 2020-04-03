<?php

namespace App\Mail;

use App\Claim;
use App\Message;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewClaim extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Claim
     */
    private $claim;

    /**
     * @var Message
     */
    private $message;

    /**
     * @var User
     */
    private $addressee;

    /**
     * Create a new message instance.
     *
     * @param  Claim  $claim
     * @param  Message  $message
     */
    public function __construct(Claim $claim, Message $message, User $addressee)
    {
        $this->claim     = $claim;
        $this->message   = $message;
        $this->addressee = $addressee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.new_claim', [
            'claim'        => $this->claim,
            'claimMessage' => $this->message,
            'addressee'    => $this->addressee
        ]);
    }
}
