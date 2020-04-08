<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['employee' =>  Employee::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'job_id' => 'required'
        ]);

        try {

            $employee = new Employee;
            $employee->first_name = $request->input('firstname');
            $employee->last_name = $request->input('lastname');
            $employee->email = $request->input('email');
            $employee->phone = $request->input('phone');
            $employee->job_id = $request->input('job_id');
            $employee->employee_id = $request->input('employee_id');
            $employee->salary = $request->input('salary');
            $employee->status = true;

            $employee->save();

            //return successful response
            return response()->json(['employee' => $employee, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Employee Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $employee = Employee::findOrFail($id);

            return response()->json(['employee' => $employee], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Employee not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'id' => 'required',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'job_id' => 'required',
            'status' => 'required'
        ]);

        try {
            $employee = new Employee;
            $employee->id = $request->input('id');
            $employee = Employee::findOrFail($employee->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Employee Not Find!', 'employee_id' => $employee->id, 'error' => $e], 409);
        }
        try {
            $employee->first_name = $request->input('firstname');
            $employee->last_name = $request->input('lastname');
            $employee->email = $request->input('email');
            $employee->phone = $request->input('phone');
            $employee->job_id = $request->input('job_id');
            $employee->employee_id = $request->input('employee_id');
            $employee->salary = $request->input('salary');
            $employee->status = $request->input('status');

            $employee->save();

            //return successful response
            return response()->json(['employee' => $employee, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Employee Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Employee Not Find!', 'employee_id' => $id, 'error' => $e], 409);
        }
        try {
            $employee->delete();
            return response()->json(['employee' => $employee, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Employee Delete Failed!', 'error' => $e], 409);
        }
    }

    public function get_waiters()
    {
        $waiter = Employee::where('job_id', 3)->get();
        $array = [];
        foreach ($waiter as $key => $value) {
            $value['table'] = Employee::Find($value->id)->tables()->get();
            array_push($array,$value);
        };
        return response()->json(['waiters' =>  $array], 200);
    }

    public function update_waiters(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'table_id' => 'required',
            'id' => 'required',
            'status' => 'required'
        ]);

        try {

            $employee = Employee::findOrFail($request->input('id'));
            $table_id = $request->input('table_id');
            $status = $request->input('status');

            if ($status) {
                $employee->tables()->attach($table_id);
            } else {
                $employee->tables()->detach($table_id);
            }

            $employee['table'] = Employee::Find($request->input('id'))->tables()->get();

            //return successful response
            return response()->json(['waiter' => $employee, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Waiter Updte Failed!', 'error' => $e], 409);
        }
    }
}
