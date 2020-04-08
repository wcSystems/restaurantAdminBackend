<?php

namespace App\Http\Controllers;

use App\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
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
        return response()->json(['payment_methods' =>  PaymentMethod::all()], 200);
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
            'name' => 'required|string'
        ]);

        try {

            $payment_method = new PaymentMethod;
            $payment_method->name = $request->input('name');

            $payment_method->save();

            //return successful response
            return response()->json(['payment_method' => $payment_method, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'PaymentMethod Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentMethod  $payment_method
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $payment_method = PaymentMethod::findOrFail($id);

            return response()->json(['payment_method' => $payment_method], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'PaymentMethod not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentMethod  $payment_method
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required|string'
        ]);

        try {
            $payment_method = new PaymentMethod;
            $payment_method->id = $request->input('id');
            $payment_method = PaymentMethod::findOrFail($payment_method->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'PaymentMethod Not Find!', 'payment_method_id' => $payment_method->id, 'error' => $e], 409);
        }
        try {
            $payment_method->name = $request->input('name');

            $payment_method->save();

            //return successful response
            return response()->json(['payment_method' => $payment_method, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'PaymentMethod Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentMethod  $payment_method
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $payment_method = PaymentMethod::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'PaymentMethod Not Find!', 'payment_method_id' => $id, 'error' => $e], 409);
        }
        try {
            $payment_method->delete();
            return response()->json(['payment_method' => $payment_method, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'PaymentMethod Delete Failed!', 'error' => $e], 409);
        }
    }
}
