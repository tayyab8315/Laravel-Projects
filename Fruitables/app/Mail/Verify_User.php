<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Verify_User extends Mailable
{
    use Queueable, SerializesModels;
    protected $User ;
    protected $token ;
    protected $task ;
    /**
     * Create a new message instance.
     */
    public function __construct($User,$comingToken,$task)
    {
        $this->User = $User; 
        $this->token = $comingToken; 
        $this->task = $task; 

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'user.sendMail',
            with:[
                'user'=>$this->User,
                'token'=>$this->token,
                'task'=>$this->task,
                  ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
