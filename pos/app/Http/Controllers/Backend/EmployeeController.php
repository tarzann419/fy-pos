<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function AllEmployee(){
        $employee = Employee::latest()->get();
        return view('backend.employee.employee_all', compact('employee'));
    }

    public function AddEmployee(){
        return view('backend.employee.add_employee');
    }


    public function StoreEmployee(Request $request){
        
    }
}
