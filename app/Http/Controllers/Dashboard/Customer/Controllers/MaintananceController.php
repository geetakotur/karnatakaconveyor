<?php

namespace App\Http\Controllers\Dashboard\Customer\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Customer\User;
use App\Http\Controllers\Controller;
use App\Models\Customer\Maintainance;
use App\Models\Customer\Order;

class MaintananceController extends Controller{

    // Home
    // public function index(Request $request)
    // {
    //     return view('view.dashboard.customer.maintanance.index');
    // }


    public function maintananceById(Request $request, $id)
    {
        $order = Order::where('id', $id)->get();
        if($order && sizeof($order) > 0){
            $order = $order->first();
        }else{
            $order = NULL;
        }

        $maintanance = Maintainance::where('order_id', $id)->orderBy('created_at', 'desc')->get();

        return view('view.dashboard.customer.maintanance.index')->with([
            'order' => $order,
            'maintanance' => $maintanance,
        ]);
    }
}
