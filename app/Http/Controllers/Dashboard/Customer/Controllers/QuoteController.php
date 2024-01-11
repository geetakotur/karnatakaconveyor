<?php

namespace App\Http\Controllers\Dashboard\Customer\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Customer\User;
use App\Http\Controllers\Controller;
use App\Models\Customer\Order;
use App\Models\Mgmt\Conveyor;

use function PHPUnit\Framework\isNull;

class QuoteController extends Controller{

    // Home
    public function index(Request $request)
    {
        $quotes = Order::where('customer_id', Auth::user()->id)
                    ->where('isQuote', true)->get();

        return view('view.dashboard.customer.quotes.index')->with([
            'quotes' => $quotes,
        ]);
    }

    // Quote New
    public function quoteNew(Request $request)
    {
        $products = Conveyor::get();

        return view('view.dashboard.customer.quotes.new')->with([
            'products' => $products,
        ]);
    }

    // get Quote New
    public function submitQuoteNew(Request $request)
    {
        $validData = $request->validate([
            'message' => 'required|string|max:500',
            'modelno' => 'required|string|max:200',
        ]);

        $quote = Order::create($validData);

        $quote->customer_id = Auth::user()->id;
        $quote->model_id = Conveyor::where('modelno', $validData['modelno'])->first()->id;
        $quote->isQuote = true;
        $quote->approved = false;
        $quote->status = Order::STATUS_PENDING;

        $quote->save();

        // dd($quote);

        return redirect()->route('customer.quotes.home');
    }

    // Quote New
    public function quoteInfo(Request $request)
    {
        $products = Conveyor::get();

        return view('view.dashboard.customer.quotes.new')->with([
            'products' => $products,
        ]);
    }

    // Quote New
    public function quoteEdit(Request $request)
    {
        $quotes = Order::where('customer_id', Auth::user()->id)->get();

        return view('view.dashboard.customer.quotes.index')->with([
            'quotes' => $quotes,
        ]);
    }

    // Quote New
    public function quoteUpdate(Request $request)
    {
        $quotes = Order::where('customer_id', Auth::user()->id)->get();

        return view('view.dashboard.customer.quotes.index')->with([
            'quotes' => $quotes,
        ]);
    }

    // Quote Delete
    public function deteteQuote(Request $request, $id)
    {
        $quote = Order::where('customer_id', Auth::user()->id)
                    ->where('isQuote', true)
                    ->where('invoiceId', $id)
                    ->where('approved', false)
                    ->where('status', Order::STATUS_PENDING)
                    ->first();

        // dd($id);
        // dd($quote);
        if($quote) $quote->delete();

        return redirect()->route('customer.quotes.home');
    }
}
