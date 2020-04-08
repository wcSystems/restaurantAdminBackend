<?php

namespace App\Http\Controllers;

use App\SaleOrderDetail;
use Illuminate\Http\Request;

class SaleOrderDetailController extends Controller
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
        return response()->json(['sale_order_details' =>  SaleOrderDetail::all()], 200);
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
            'rest_menu_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'sale_order_id' => 'required'
        ]);

        try {

            $sale_order_detail = new SaleOrderDetail;
            $sale_order_detail->rest_menu_id = $request->input('rest_menu_id');
            $sale_order_detail->quantity = $request->input('quantity');
            $sale_order_detail->price = $request->input('price');
            $sale_order_detail->discount = $request->input('discount');
            $sale_order_detail->sale_order_id = $request->input('sale_order_id');

            $sale_order_detail->save();

            //return successful response
            return response()->json(['sale_order_detail' => $sale_order_detail, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'SaleOrderDetail Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaleOrderDetail  $sale_order_detail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $sale_order_detail = SaleOrderDetail::findOrFail($id);

            return response()->json(['sale_order_detail' => $sale_order_detail], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'SaleOrderDetail not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaleOrderDetail  $sale_order_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'id' => 'required',
            'rest_menu_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'sale_order_id' => 'required'
        ]);

        try {
            $sale_order_detail = new SaleOrderDetail;
            $sale_order_detail->id = $request->input('id');
            $sale_order_detail = SaleOrderDetail::findOrFail($sale_order_detail->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'SaleOrderDetail Not Find!', 'sale_order_detail_id' => $sale_order_detail->id, 'error' => $e], 409);
        }
        try {
            $sale_order_detail->rest_menu_id = $request->input('rest_menu_id');
            $sale_order_detail->quantity = $request->input('quantity');
            $sale_order_detail->price = $request->input('price');
            $sale_order_detail->discount = $request->input('discount');
            $sale_order_detail->sale_order_id = $request->input('sale_order_id');

            $sale_order_detail->save();

            //return successful response
            return response()->json(['sale_order_detail' => $sale_order_detail, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'SaleOrderDetail Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaleOrderDetail  $sale_order_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $sale_order_detail = SaleOrderDetail::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'SaleOrderDetail Not Find!', 'sale_order_detail_id' => $id, 'error' => $e], 409);
        }
        try {
            $sale_order_detail->delete();
            return response()->json(['sale_order_detail' => $sale_order_detail, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'SaleOrderDetail Delete Failed!', 'error' => $e], 409);
        }
    }
}
