<?php

namespace App\Http\Controllers;

use App\PurchaseOrderDetail;
use Illuminate\Http\Request;

class PurchaseOrderDetailController extends Controller
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
        return response()->json(['purchase_order_details' =>  PurchaseOrderDetail::all()], 200);
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
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'purchase_order_id' => 'required'
        ]);

        try {

            $purchase_order_detail = new PurchaseOrderDetail;
            $purchase_order_detail->product_id = $request->input('product_id');
            $purchase_order_detail->quantity = $request->input('quantity');
            $purchase_order_detail->price = $request->input('price');
            $purchase_order_detail->purchase_order_id = $request->input('purchase_order_id');

            $purchase_order_detail->save();

            //return successful response
            return response()->json(['purchase_order_detail' => $purchase_order_detail, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'PurchaseOrderDetail Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseOrderDetail  $purchase_order_detail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $purchase_order_detail = PurchaseOrderDetail::findOrFail($id);

            return response()->json(['purchase_order_detail' => $purchase_order_detail], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'PurchaseOrderDetail not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseOrderDetail  $purchase_order_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'purchase_order_id' => 'required'
        ]);

        try {
            $purchase_order_detail = new PurchaseOrderDetail;
            $purchase_order_detail->id = $request->input('id');
            $purchase_order_detail = PurchaseOrderDetail::findOrFail($purchase_order_detail->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'PurchaseOrderDetail Not Find!', 'purchase_order_detail_id' => $purchase_order_detail->id, 'error' => $e], 409);
        }
        try {
            $purchase_order_detail->product_id = $request->input('product_id');
            $purchase_order_detail->quantity = $request->input('quantity');
            $purchase_order_detail->price = $request->input('price');
            $purchase_order_detail->purchase_order_id = $request->input('purchase_order_id');

            $purchase_order_detail->save();

            //return successful response
            return response()->json(['purchase_order_detail' => $purchase_order_detail, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'PurchaseOrderDetail Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseOrderDetail  $purchase_order_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $purchase_order_detail = PurchaseOrderDetail::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'PurchaseOrderDetail Not Find!', 'purchase_order_detail_id' => $id, 'error' => $e], 409);
        }
        try {
            $purchase_order_detail->delete();
            return response()->json(['purchase_order_detail' => $purchase_order_detail, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'PurchaseOrderDetail Delete Failed!', 'error' => $e], 409);
        }
    }
}
