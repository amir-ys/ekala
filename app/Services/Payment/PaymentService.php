<?php

namespace App\Services\Payment;

use App\Gateways\Gateway;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;

class PaymentService
{
    public static function generate(string $paymentMethod, $amounts)
    {
        $order = static::storeOrder($amounts, $paymentMethod);
        static::storeTransaction($order, $amounts);
    }

    public static function storeOrder($amounts, $paymentMethod)
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'user_address_id' => 1,
            'coupon_id' => is_array($amounts['coupon_amount']) ? $amounts['coupon_amount']['coupon'] : null,
            'status' => Order::STATUS_PENDING,
            'total_amount' => $amounts['total_amount'],
            'delivery_amount' => $amounts['delivery_amount'],
            'coupon_amount' => is_array($amounts['coupon_amount']) ? $amounts['coupon_amount']['amount'] : $amounts['coupon_amount'],
            'paying_amount' => $amounts['paying_amount'],
            'payment_type' => $paymentMethod,
        ]);

        if ($order) {
            static::storeOrderItem($order);
        }

        return $order;
    }

    private static function storeOrderItem($order)
    {
        foreach (\Cart::getContent() as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->id,
                'price' => $price = $cartItem->associatedModel->price,
                'quantity' => $quantity = $cartItem->quantity,
                'total' => $quantity * $price,
            ]);
        }
    }

    private static function storeTransaction($order, $amounts)
    {
        $gateway = resolve(Gateway::class);
        $token = $gateway->request( $amounts['paying_amount'] , 'پرداخت سفارش');
        Transaction::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'amount' => $amounts['paying_amount'],
            'token' => $token ,
            'gateway_name' => 'pay',
            'description' => null,
            'status' => Transaction::STATUS_PENDING,
        ]);
    }
}
