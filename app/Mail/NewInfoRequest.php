<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\InfoRequest;

class NewInfoRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * New info istance
     * 
     */

    protected $infoRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(InfoRequest $infoRequest)
    {
        $this->infoRequest = $infoRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->infoRequest->email)
                    // ->view('mail.new-info-request')
                    ->markdown('mail.new-info-request')
                    ->with([
                        'title' => $this->infoRequest->title,
                        'body' => $this->infoRequest->body
                    ]);
    }
}
