<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    public function AllEmployee()
    {
        $employee = Employee::latest()->get();
        return view('backend.employee.employee_all', compact('employee'));
    }

    public function AddEmployee()
    {
        return view('backend.employee.add_employee');
    }


    // public function StoreEmployee(Request $request)
    // {
    //     $validateData = $request->validate([
    //         'name' => 'required|max:200', //max words of 200
    //         'email' => 'required|unique:employees|max:200',
    //         'phone' => 'required|max:200',
    //         'address' => 'required|max:400',
    //         'salary' => 'required|max:200',
    //         'vacation' => 'required|max:200',


    //     ]);

    //     //checking the image
    //     $image = $request->file('image');
    //     $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); //generate a name in id form
    //     Image::make($image)->resize(300,300)->save('upload/employee/'.$name_gen);//to resize
    //     $save_url = 'upload/employee/'.$name_gen;

    //     Employee::insert([
    //         //db name => $request->html name
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'address' => $request->address,
    //         'salary' => $request->salary,
    //         'vacation' => $request->vacation,
    //         'experience' => $request->experience,
    //         'city' => $request->city,
    //         'image' => $save_url,
    //         'created_at' => Carbon::now(),
    //         'city' => $request->city,
    //     ]);

    //     $notification = array(
    //         'message' => 'Employee Added Successfully',
    //         'alert-type' => 'success'
    //     );

    //     return redirect()->route('all.employee')->with($notification);

    // }



    public function StoreEmployee(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:employees|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'salary' => 'required|max:200',
            'vacation' => 'required|max:200',
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/employee/' . $name_gen);
        $save_url = 'upload/employee/' . $name_gen;

        Employee::insert(
            [

                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'experience' => $request->experience,
                'salary' => $request->salary,
                'vacation' => $request->vacation,
                'city' => $request->city,
                'image' => $save_url,
                'created_at' => Carbon::now(),

            ],
            [
                // setting up custom error messages
                'name.required' => 'This EMPLOYEE field is required',
            ]
        );

        $notification = array(
            'message' => 'Employee Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.employee')->with($notification);
    } // End Method 

    public function EditEmployee($id){

        $employee = Employee::findOrFail($id);
        return view('backend.employee.edit_employee', compact('employee'));
    }

    public function UpdateEmployee(Request $request){
        
    }
}
