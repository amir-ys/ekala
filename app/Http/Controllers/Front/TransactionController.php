<?php

namespace App\Http\Controllers\Front;

use App\Events\PaymentWasSuccess;
use App\Gateways\Gateway;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function callback(Request $request)
    {
        $token = $this->getTokenFromRequest($request);
        $gateway = resolve(Gateway::class);
        $transaction = Transaction::query()->where('token' , $token)->first();
        $result = $gateway->verify($request , $transaction->amount);
        if (!$transaction){
            return back();
        }


        if (is_array($result)){
            cache()->forget('payment_method');
            $transaction->status = Transaction::STATUS_FAILED;
            $transaction->save();
            Order::query()->where('id' , $transaction->id)->first()->update(['status' => Order::STATUS_FAILED]);
            return redirect()->route('home');
        } else{
            event(new PaymentWasSuccess());
            cache()->forget('payment_method');
            $transaction->status = Transaction::STATUS_SUCCESS;
            $transaction->ref_id = $result;
            $transaction->save();
            Order::query()->where('id' , $transaction->id)->first()->update(['status' => Order::STATUS_SUCCESS]);
            return redirect()->route('home');
        }
    }

    public function getTokenFromRequest(Request $request): mixed
    {
        if (cache()->get('payment_method') == Transaction::PAYMENT_METHOD_ZARINPAL) return $request->Authority;
        if (cache()->get('payment_method') == Transaction::PAYMENT_METHOD_PAY) return $request->token;
        if (cache()->get('payment_method') == Transaction::PAYMENT_METHOD_ZIBAL) return $request->trackId ;;
    }
}
