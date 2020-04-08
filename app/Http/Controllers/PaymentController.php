<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
        return response()->json(['payments' =>  Payment::all()], 200);
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
            'customer_id' => 'required',
            'date_payment' => 'required',
            'amount' => 'required',
            'reference_number' => 'required',
            'payment_method_id' => 'required'
        ]);

        try {

            $payment = new Payment;
            $payment->customer_id = $request->input('customer_id');
            $payment->date_payment = $request->input('date_payment');
            $payment->amount = $request->input('amount');
            $payment->reference_number = $request->input('reference_number');
            $payment->payment_method_id = $request->input('payment_method_id');

            $payment->save();

            //return successful response
            return response()->json(['payment' => $payment, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Payment Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $payment = Payment::findOrFail($id);

            return response()->json(['payment' => $payment], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Payment not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'id' => 'required',
            'customer_id' => 'required',
            'date_payment' => 'required',
            'amount' => 'required',
            'reference_number' => 'required',
            'payment_method_id' => 'required'
        ]);

        try {
            $payment = new Payment;
            $payment->id = $request->input('id');
            $payment = Payment::findOrFail($payment->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Payment Not Find!', 'payment_id' => $payment->id, 'error' => $e], 409);
        }
        try {
            $payment->customer_id = $request->input('customer_id');
            $payment->date_payment = $request->input('date_payment');
            $payment->amount = $request->input('amount');
            $payment->reference_number = $request->input('reference_number');
            $payment->payment_method_id = $request->input('payment_method_id');

            $payment->save();

            //return successful response
            return response()->json(['payment' => $payment, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Payment Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $payment = Payment::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Payment Not Find!', 'payment_id' => $id, 'error' => $e], 409);
        }
        try {
            $payment->delete();
            return response()->json(['payment' => $payment, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Payment Delete Failed!', 'error' => $e], 409);
        }
    }
}
