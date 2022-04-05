<?php

namespace App\Http\Controllers\Panel\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->latest()->paginate();
        return view('panel.orders.index' , compact('orders'));
    }
}
