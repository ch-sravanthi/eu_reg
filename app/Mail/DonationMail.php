<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\SeminarProposalStatus;
 

class DonationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $message;
    public $subject;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $message, $receipt)
    {
       
        $this->message = $message;
        $this->subject = $subject;
        $this->receipt = $receipt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$previous_receipt=''; 
        $mail = $this->markdown('mail.project_bill')
                    ->with([                        
                        'subject' => $this->subject,
						'message' => $this->message]);	
						if(!empty($this->receipt))
						{
							$mail->attach($this->receipt->getRealPath(), ['as' => $this->receipt->getClientOriginalName(),'mime' => $this->receipt->getMimeType()
						]);
						}
		return $mail;
	}
}
