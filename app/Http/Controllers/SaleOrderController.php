<?php

namespace App\Http\Controllers;

use App\SaleOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SaleOrderController extends Controller
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
        return response()->json(['sale_order' =>  SaleOrder::all()], 200);
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
            'table_id' => 'required'
        ]);

        try {
            $table_id = $request->input('table_id');

            $sale_order = new SaleOrder;

           // $sale_order->num_invoice = substr(str_shuffle("0123456789"), 0, 10);
            $sale_order->date = Carbon::now()->format('Y-m-d');
            $sale_order->user_id = Auth::id();

            $sale_order->save();

            $sale_order->tables()->attach($table_id);

            //return successful response
            return response()->json(['sale_order' => $sale_order, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'SaleOrder Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaleOrder  $sale_order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $sale_order = SaleOrder::findOrFail($id);

            return response()->json(['sale_order' => $sale_order], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'SaleOrder not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaleOrder  $sale_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'id' => 'required'
        ]);

        try {
            $sale_order = new SaleOrder;
            $sale_order->id = $request->input('id');
            $sale_order = SaleOrder::findOrFail($sale_order->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'SaleOrder Not Find!', 'sale_order_id' => $sale_order->id, 'error' => $e], 409);
        }
        try {
            $sale_order->num_invoice = $request->input('num_invoice');
            $sale_order->status_order_id = $request->input('status_order_id');
            $sale_order->customer_id = $request->input('customer_id');
            $sale_order->order_type_id = $request->input('order_type_id');
            $sale_order->user_id = Auth::id();
            $sale_order->comment = $request->input('comment');

            $sale_order->save();

            //return successful response
            return response()->json(['sale_order' => $sale_order, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'SaleOrder Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleOrder  $sale_order
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleOrder $sale_order)
    {
        //
    }

    public function details($id)
    {
        try {
            $sale_order_details = SaleOrder::findOrFail($id)->sale_order_details()->get();

            return response()->json(['sale_order_details' => $sale_order_details], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'SaleOrder not found!'], 404);
        }
    }
}
