<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;

class SmsChannel
{

    public function send($notifiable , Notification $notification)
    {
        $ghasedak = new \Ghasedak\GhasedakApi(env('GHASEDAK_API_KEY')) ;
        $receptor = $notifiable->mobile;
        $type =1 ;
        $template = 'ekala' ;
        $param1 = $notification->code ;
        $ghasedak->Verify($receptor, $type , $template , $param1);
    }

}
