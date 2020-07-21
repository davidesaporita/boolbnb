<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Message;

class NewMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * New info istance
     * 
     */

    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->message->email)
                    // ->view('mail.new-info-request')
                    ->markdown('mail.new-info-request')
                    ->with([
                        'title' => $this->message->title,
                        'body' => $this->message->body
                    ]);
    }
}
