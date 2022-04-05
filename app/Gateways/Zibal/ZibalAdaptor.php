<?php

namespace App\Gateways\Zibal;

class ZibalAdaptor
{
    private Zibal $client;
    private string $url;

    public function request($amount , $description)
    {
        $this->client = new Zibal();
        $callback = route('front.transaction.callback');
        $result = $this->client->request(config('payment_method.zibal.merchant') , $amount , $description , '' , '' ,$callback);
        if ($result->result == 100){
            $this->url =  "https://gateway.zibal.ir/start/".$result->trackId;
            return $result->trackId;
        }
    }

    public function verify($merchant , $trackId)
    {
        $trackId =  $_GET['trackId'];
        $this->client = new Zibal();
        $response = $this->client->verify(config('payment_method.zarinpal.merchant') , $trackId );
        if ($response->result == 100) {
            return $response->traceId;
        } else {
            return [
                'status' => $response->status,
                'message' => $response->message,

            ];
        }

    }

    public function redirect()
    {
        $this->client->redirect($this->url);
    }
}
