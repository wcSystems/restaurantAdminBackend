<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
        return response()->json(['customers' =>  Customer::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $customer = new Customer;
            $customer->identity_card = $request->input('identity_card');
            $customer->firstname = $request->input('firstname');
            $customer->lastname = $request->input('lastname');
            $customer->phone = $request->input('phone');
            $customer->address = $request->input('address');
            $customer->email = $request->input('email');

            $customer->save();

            //return successful response
            return response()->json(['customer' => $customer, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Customer Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $customer = Customer::findOrFail($id);

            return response()->json(['customer' => $customer], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Customer not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'id' => 'required'
        ]);

        try {
            $customer = new Customer;
            $customer->id = $request->input('id');
            $customer = Customer::findOrFail($customer->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Customer Not Find!', 'customer_id' => $customer->id, 'error' => $e], 409);
        }
        try {
            $customer->identity_card = $request->input('identity_card');
            $customer->firstname = $request->input('firstname');
            $customer->lastname = $request->input('lastname');
            $customer->phone = $request->input('phone');
            $customer->address = $request->input('address');
            $customer->email = $request->input('email');

            $customer->save();

            //return successful response
            return response()->json(['customer' => $customer, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Customer Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Customer Not Find!', 'customer_id' => $id, 'error' => $e], 409);
        }
        try {
            $customer->delete();
            return response()->json(['customer' => $customer, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Customer Delete Failed!', 'error' => $e], 409);
        }
    }

    public function searchByIdentity($identity_card)
    {
        try {
            $customer = Customer::where('identity_card', 'LIKE', "{$identity_card}%")->get();

            return response()->json(['customer' => $customer], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Customer not found!'], 404);
        }
    }
}
