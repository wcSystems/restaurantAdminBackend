<?php

namespace App\Http\Controllers;

use App\PurchaseOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PurchaseOrderController extends Controller
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
        return response()->json(['purchase_order' =>  PurchaseOrder::paginate(10)], 200);
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
            'provider_id' => 'required'
        ]);

        try {
            $table_id = $request->input('table_id');

            $purchase_order = new PurchaseOrder;

            $purchase_order->date = Carbon::now()->format('Y-m-d');
            $purchase_order->num_invoice = $request->input('num_invoice');
            $purchase_order->required_date = $request->input('required_date');
            $purchase_order->purchase_date = $request->input('purchase_date');
            $purchase_order->arrival_date = $request->input('arrival_date');
            $purchase_order->provider_id = $request->input('provider_id');
            $purchase_order->user_id = Auth::id();

            $purchase_order->save();

            //return successful response
            return response()->json(['purchase_order' => $purchase_order, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'PurchaseOrder Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseOrder  $purchase_order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $purchase_order = PurchaseOrder::findOrFail($id);

            return response()->json(['purchase_order' => $purchase_order], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'PurchaseOrder not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseOrder  $purchase_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'id' => 'required'
        ]);

        try {
            $purchase_order = new PurchaseOrder;
            $purchase_order->id = $request->input('id');
            $purchase_order = PurchaseOrder::findOrFail($purchase_order->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'PurchaseOrder Not Find!', 'purchase_order_id' => $purchase_order->id, 'error' => $e], 409);
        }
        try {
            $purchase_order->date = Carbon::now()->format('Y-m-d');
            $purchase_order->num_invoice = $request->input('num_invoice');
            $purchase_order->required_date = $request->input('required_date');
            $purchase_order->purchase_date = $request->input('purchase_date');
            $purchase_order->arrival_date = $request->input('arrival_date');
            $purchase_order->provider_id = $request->input('provider_id');
            $purchase_order->user_id = Auth::id();
            $purchase_order->status = $request->input('status');

            $purchase_order->save();

            //return successful response
            return response()->json(['purchase_order' => $purchase_order, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'PurchaseOrder Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseOrder  $purchase_order
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchase_order)
    {
        //
    }

    public function details($id)
    {
        try {
            $purchase_order_details = PurchaseOrder::findOrFail($id)->purchase_order_details()->get();

            return response()->json(['purchase_order_details' => $purchase_order_details], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'PurchaseOrder not found!'], 404);
        }
    }
}
