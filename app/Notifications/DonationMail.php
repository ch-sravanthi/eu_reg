<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DonationMail extends Notification implements ShouldQueue
{
    use Queueable;
	
    protected $message;
    protected $subject;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subject,$message)
    {
        $this->message = $message;
        $this->subject = $subject;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
					->subject($this->subject)
                   ->markdown('mail.doantion', [
                        'route' => 'http://localhost',                      
						'message' => $this->message
						
						]);
						
    }
	

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
