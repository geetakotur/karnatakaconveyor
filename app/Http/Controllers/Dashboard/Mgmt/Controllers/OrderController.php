<?php

namespace App\Http\Controllers\Dashboard\Mgmt\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Mgmt\User;
use App\Http\Controllers\Controller;
use App\Models\Customer\Order;
use Carbon\Carbon;

class OrderController extends Controller{

    // Home
    public function index(Request $request)
    {
        $orders = Order::orderBy('id', 'desc')
                    ->where('isQuote', false)
                    ->get();

        return view('view.dashboard.mgmt.orders.index')->with([
            'orders' => $orders,
        ]);
    }

    public function orderView(Request $request, $id)
    {
        $order = Order::where('isQuote', false)
                    ->where('invoiceId', $id)
                    ->first();
        // dd($id);
        // dd($order);

        return view('view.dashboard.mgmt.orders.view')->with([
            'order' => $order,
        ]);
    }

    public function orderEditView(Request $request, $id)
    {
        $order = Order::where('isQuote', false)
                    ->where('invoiceId', $id)
                    ->first();

        // dd($id);
        // dd($order);

        return view('view.dashboard.mgmt.orders.edit')->with([
            'order' => $order,
        ]);
    }

    // 
    public function orderUpdate(Request $request, $id)
    {
        $validData = $request->validate([
            'message' => 'required|string|max:500',
            'total' => 'required|integer|min:5',
        ]);

        $order = Order::where('invoiceId', $id)
                    ->first();

        $order->isQuote = false;
        $order->approved = true;
        
        // $order->status = Order::STATUS_DUE;
        // $order->order_date = Carbon::now()->toDateTimeString();
        
        $order->message = $validData['message'];
        $order->total = $validData['total'];

        $order->save();

        // dd($id);
        // dd($order);

        return redirect()->route('mgmt.orders.home');
    }

    // 
    public function orderCancle(Request $request, $id)
    {
        $order = Order::where('invoiceId', $id)
                    ->first();

        $order->status = Order::STATUS_CANCELLED;
        $order->order_date = Carbon::now()->toDateTimeString();


        $order->save();

        // dd($id);
        // dd($order);

        return redirect()->route('mgmt.orders.home');
    }

    // deteteOrder by id
    public function orderDelete(Request $request, $id)
    {
        $order = Order::where('isQuote', false)
                    ->where('invoiceId', $id)
                    ->first();

        // dd($id);
        // dd($order);
        if($order) $order->delete();

        return redirect()->route('mgmt.orders.home');
    }
}
