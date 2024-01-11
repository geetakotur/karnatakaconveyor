<?php

namespace App\Http\Controllers\Dashboard\Mgmt\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Mgmt\User;
use App\Http\Controllers\Controller;
use App\Models\Customer\Order;
use App\Models\Mgmt\Conveyor;

class QuoteController extends Controller{

    // Home
    public function index(Request $request)
    {
        $quotes = Order::orderBy('id', 'desc')
                    ->where('isQuote', true)
                    ->get();

        return view('view.dashboard.mgmt.quotes.index')->with([
            'quotes' => $quotes,
        ]);
    }

    // Edit Quote by id
    public function quoteEdit(Request $request, $id)
    {
        $quote = Order::where('isQuote', true)
                    ->where('invoiceId', $id)
                    ->first();

        // dd($id);
        // dd($quote);

        return view('view.dashboard.mgmt.quotes.edit')->with([
            'quote' => $quote,
        ]);
    }

    // 
    public function quoteUpdate(Request $request, $id)
    {
        $validData = $request->validate([
            'message' => 'required|string|max:500',
            'total' => 'required|integer|min:5',
        ]);

        $quote = Order::where('isQuote', true)
                    ->where('invoiceId', $id)
                    ->first();

        $quote->isQuote = false;
        $quote->approved = true;
        $quote->status = Order::STATUS_DUE;
        
        $quote->message = $validData['message'];
        $quote->total = $validData['total'];

        $quote->save();

        // dd($id);
        // dd($quote);

        return redirect()->route('mgmt.quotes.home');
    }

    // deteteQuote by id
    public function deteteQuote(Request $request, $id)
    {
        $quote = Order::where('isQuote', true)
                    ->where('invoiceId', $id)
                    ->first();

        // dd($id);
        // dd($quote);
        if($quote) $quote->delete();

        return redirect()->route('mgmt.quotes.home');
    }
}
