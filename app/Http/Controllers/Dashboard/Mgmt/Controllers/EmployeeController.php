<?php

namespace App\Http\Controllers\Dashboard\Mgmt\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Mgmt\User;
use App\Http\Controllers\Controller;
use App\Models\Customer\User as CustomerUser;
use App\Models\Mgmt\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller{

    // Home
    public function index(Request $request)
    {
        $employees = Employee::orderBy('id', 'asc')->get();
        // dd($employees);
        return view('view.dashboard.mgmt.employee.index')->with([
            'employees' => $employees,
        ]);
    }

    // 
    public function employeeNewView(Request $request)
    {
        return view('view.dashboard.mgmt.employee.new');
    }

    // 
    public function employeeNew(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|string|max:50',
            'address' => 'required|string|max:250',
            'salary' => 'required|string|max:50',
        ]);

        $validData['joining_date'] = Carbon::now();

        // dd($validData);

        $employee = Employee::create($validData);

        $employee->save();


        return redirect()->route('mgmt.employees.home');
    }

    // 
    public function employeeEdit(Request $request, $id)
    {
        $employee = Employee::where('eid', $id)
                    ->first();

        return view('view.dashboard.mgmt.employee.edit')->with([
            'employee' => $employee,
        ]);
    }

    // 
    public function employeeUpdate(Request $request, $id)
    {
        $validData = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|string|max:50',
            'address' => 'required|string|max:250',
            'salary' => 'required|string|max:50',
        ]);

        $employee = Employee::where('eid', $id)
                    ->first();

        $employee->update($validData);
        $employee->save();

        return redirect()->route('mgmt.employees.home');
    }

    // 
    public function employeeDelete(Request $request, $id)
    {
        $employee = Employee::where('eid', $id)
                    ->first();

        if($employee) $employee->delete();
        
        return redirect()->route('mgmt.employees.home');
    }
}
