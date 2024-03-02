<?php
namespace App\Channels;

use Illuminate\Notifications\Notification;

class ProjectBillSmsMessageChannel
{
    
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSmsMessage($notifiable);
       
        $dest_mobileno=$notifiable->phone;
        $sms = urlencode(htmlspecialchars($message));

        $username = "Sblctf"; //use your sms api username
        $pass = "Fasblct"; //enter your password
        $senderid = "SBLCIT";//BTOYOU use your sms api sender id
        $priority = "ndnd";//BTOYOU use your sms api sender id
        $stype = "normal";//BTOYOU use your sms api sender id
        $sms_url = "http://bhashsms.com/api/sendmsg.php?user=$username&pass=$pass&sender=$senderid&phone=$dest_mobileno&text=$sms&priority=$priority&stype=$stype";
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$sms_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_TIMEOUT, '3');
        $content = trim(curl_exec($ch));
        curl_close($ch);
    }
    

}