<?php

namespace App\Gateways\Pay;


class PayAdaptor
{
    public $url ;
    public $client ;
    public function request($amount , $description)
    {
        $this->client = new Pay();
        $callbackUrl = route('front.transaction.callback');
        $result  = $this->client->request('test' , $amount , $callbackUrl , '' , '' ,$description  );
        if (isset($result["status"]) && $result["status"] == 1) {
            $this->url = $result['startPay'];
            return $result['token'];
        } else {
            return [
                'status' => $result['status'],
                'message' => $result['errorMessage']
            ];
        }
    }

    public function verify()
    {
        $api = 'test';
        $this->client = new Pay();
        $result = $this->client->verify($api);
        if(isset($result->status)){
            if($result->status == 1){
                return  $result->transId;
            }
        } else {
            if($_GET['status'] == 0){
                return  [
                    'status' => 0 ,
                    'message' => 'تراکنش با خطا مواجه شد'
                ];
            }
        }
    }

    public function redirect()
    {
        $this->client->redirect($this->url);
    }

}
