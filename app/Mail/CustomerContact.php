<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Customer;
use App\Models\Message;
use Illuminate\Support\Facades\Log;

class CustomerContact extends Mailable
{
    use Queueable, SerializesModels;

	public $customer;
	public $messageObj;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Customer $customer, Message $message)
    {
		$this->customer = $customer;
		$this->messageObj = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		return $this->from('contacto@rottor.mx')->cc('vledhint@gmail.com')->view('emails.customer.contact');
    }
}
