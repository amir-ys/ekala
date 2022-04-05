<?php


return [
    'zarinpal' => [
        'name' => 'درگاه پرداخت زرین پال' ,
        'class' => \App\Gateways\Zarinpal\ZarinpalAdaptor::class ,
    ] ,
    'pay' => [
        'name' => 'درگاه پرداخت پی' ,
        'class' => \App\Gateways\Pay\PayAdaptor::class ,
    ] ,
];
