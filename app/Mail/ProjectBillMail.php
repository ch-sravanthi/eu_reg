<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\SeminarProposalStatus;
 

class ProjectBillMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $message;
    public $subject;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $message, $receipts)
    {
       
        $this->message = $message;
        $this->subject = $subject;
        $this->receipts = $receipts;
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
			if ($this->receipts) {
				foreach($this->receipts as $receipt)
				{
					if($receipt->getClientOriginalName()!=$previous_receipt)
					{
						$mail->attach($receipt->getRealPath(), [
							'as' => $receipt->getClientOriginalName(), 
							'mime' => $receipt->getMimeType()
						]);
						$previous_receipt=$receipt->getClientOriginalName();
					}
				}
			}
		return $mail;
	}
}
