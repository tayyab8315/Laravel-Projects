<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    protected $cart ;
    protected $sendername ;
    protected $Order_number ;
    /**
     * Create a new message instance.
     */
    public function __construct($cart,$sendername,$Order_number)
    {
        $this->cart = $cart; 
        $this->sendername = $sendername;
        $this->Order_number = $Order_number;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'user.order_confirm',
            with:[
                'cart'=>$this->cart,
                'sender'=>$this->sendername,
                'ordernum'=>$this->Order_number,
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
