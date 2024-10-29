<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $enquiryData;

    /**
     * Create a new message instance.
     *@param array $enquiryData
     * @return void
     */
    public function __construct($enquiryData)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Enquiry Submitted')
                    ->view('emails.enquiry')
                    ->with('enquiryData', $this->enquiryData);
    }
}
