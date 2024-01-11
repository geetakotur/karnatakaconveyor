<?php

namespace App\Http\Controllers\Dashboard\Mgmt\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Mgmt\User;
use App\Http\Controllers\Controller;
use App\Models\Customer\User as CustomerUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller{

    // Home
    public function index(Request $request)
    {
        $customers = CustomerUser::orderBy('id', 'asc')->get();
        return view('view.dashboard.mgmt.customer.index')->with([
            'customers' => $customers,
        ]);
    }

    // 
    public function customerNewView(Request $request)
    {
        return view('view.dashboard.mgmt.customer.new');
    }

    // 
    public function customerNew(Request $request)
    {
        $validData = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',

            'email' => 'required|string|max:50',
            'mobile' => 'required|string|max:15',
            'address' => 'required|string|max:250',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:50',

            'username' => 'required|string|max:50',
            'password' => 'required|string|max:80',
        ]);

        $validData['registerd_on'] = Carbon::now();

        // dd($validData);

        $customer = CustomerUser::create($validData);

        $customer->password = Hash::make($validData['password']);

        $customer->save();


        return redirect()->route('mgmt.customer.home');
    }

    // 
    public function customerEdit(Request $request, $id)
    {
        $customer = CustomerUser::where('username', $id)
                    ->first();

        return view('view.dashboard.mgmt.customer.edit')->with([
            'customer' => $customer,
        ]);
    }

    // 
    public function customerUpdate(Request $request, $id)
    {
        $validData = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',

            'email' => 'required|string|max:50',
            'mobile' => 'required|string|max:15',
            'address' => 'required|string|max:250',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:50',

            'username' => 'required|string|max:50',
            'password' => 'required|string|max:80',
        ]);

        $customer = CustomerUser::where('username', $id)
                    ->first();

        $customer->update($validData);

        $customer->password = Hash::make($validData['password']);
        $customer->save();

        return redirect()->route('mgmt.customer.home');
    }

    // 
    public function customerDelete(Request $request, $id)
    {
        $customer = CustomerUser::where('username', $id)
                    ->first();

        if($customer) $customer->delete();
        
        return redirect()->route('mgmt.customer.home');
    }
}
