<?php

namespace App\Http\Controllers\Dashboard\Customer\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Customer\User;
use App\Http\Controllers\Controller;
use App\Models\Customer\Order;
use Carbon\Carbon;

class OrderController extends Controller{

    // Home
    public function index(Request $request)
    {
        $orders = Order::where('customer_id', Auth::user()->id)
                    ->where('isQuote', false)
                    ->orderBy('order_date', 'desc')
                    ->get();

        // dd($orders);

        return view('view.dashboard.customer.orders.index')->with([
            'orders' => $orders,
        ]);
    }

    // Pay order
    public function orderPaynowView(Request $request, $id)
    {
        $order = Order::where('customer_id', Auth::user()->id)
                    ->where('isQuote', false)
                    ->where('invoiceId', $id)
                    ->first();

        return view('view.dashboard.customer.orders.paynow')->with([
            'order' => $order,
        ]);
    }

    // Pay order
    public function orderPaynow(Request $request, $id)
    {
        $validData = $request->validate([
            'payment' => 'required|string|max:50',
        ]);


        $order = Order::where('customer_id', Auth::user()->id)
                    ->where('isQuote', false)
                    ->where('invoiceId', $id)
                    ->first();

        // Redirect if status is not set to due
        if($order->status != Order::STATUS_DUE){
            return redirect()->route('customer.orders.home');
        }

        $order->payment = $validData['payment'];
        $order->status = Order::STATUS_CLOSED;
        $order->order_date = Carbon::now()->toDateTimeString();

        $order->save();

        // dd($order);

        return redirect()->route('customer.orders.home');
    }


    // viewInvoice
    public function orderViewInvoice(Request $request, $id)
    {
        $order = Order::where('customer_id', Auth::user()->id)
                    ->where('isQuote', false)
                    ->where('invoiceId', $id)
                    ->first();

        // dd($order);

        return view('view.dashboard.customer.orders.viewInvoice')->with([
            'order' => $order,
        ]);
    }

    // orderCancle
    public function orderCancle(Request $request, $id)
    {
        $order = Order::where('customer_id', Auth::user()->id)
                    ->where('isQuote', false)
                    ->where('invoiceId', $id)
                    ->first();

        $order->payment = '----';
        $order->status = Order::STATUS_CANCELLED;
        $order->order_date = Carbon::now()->toDateTimeString();

        $order->save();

        // dd($order);

        return redirect()->route('customer.orders.home');
    }
}
