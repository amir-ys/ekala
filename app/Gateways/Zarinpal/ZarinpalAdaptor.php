<?php


namespace App\Gateways\Zarinpal;


use App\Contracts\GatewayContract;

class ZarinpalAdaptor implements GatewayContract
{
    private $url;
    private $client;

    public function request($amount, $description)
    {
        $this->client = new Zarinpal();
        $callback = route('front.transaction.callback');
        $result = $this->client->request(config('payment_method.zarinpal.merchant'), $amount, $description,
            '', '', $callback, true);
        if (isset($result["Status"]) && $result["Status"] == 100) {
            $this->url = $result['StartPay'];
            return $result['Authority'];
        } else {
            return [
                'status' => $result['Status'],
                'message' => $result['Message']
            ];
        }
    }

    public function verify($request , $amount)
    {
        $this->client = new Zarinpal();
        $result = $this->client->verify(config('payment_method.zarinpal.merchant'),$amount, true);

        if (isset($result["Status"]) && $result["Status"] == 100) {
            return $result["RefID"];
        } else {
            return [
                'status' => $result["Status"],
                'message' => $result["Message"]
            ];
        }
    }

    public function redirect()
    {
        $this->client->redirect($this->url);
    }

    public function getName()
    {
        return 'zarinpal';
    }

}
