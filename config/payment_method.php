<?php


return [
    'zarinpal' => [
        'name' => 'درگاه پرداخت زرین پال' ,
        'class' => \App\Gateways\Zarinpal\ZarinpalAdaptor::class ,
        'merchant' => "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" ,
    ] ,
    'pay' => [
        'name' => 'درگاه پرداخت پی' ,
        'class' => \App\Gateways\Pay\PayAdaptor::class ,
        'merchant' => 'test' ,

    ] ,
    'zibal' => [
        'name' => 'درگاه پرداخت زیبال' ,
        'class' => \App\Gateways\Zibal\ZibalAdaptor::class ,
        'merchant' => 'zibal' ,
    ] ,
];
