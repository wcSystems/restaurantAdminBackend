<?php

namespace App\Http\Controllers;

use App\OrderType;
use Illuminate\Http\Request;

class OrderTypeController extends Controller
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
        return response()->json(['order_type' =>  OrderType::all()], 200);
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

            $order_type = new OrderType;
            $order_type->name = $request->input('name');

            $order_type->save();

            //return successful response
            return response()->json(['order_type' => $order_type, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'order_type Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderType  $OrderType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $order_type = OrderType::findOrFail($id);

            return response()->json(['order_type' => $order_type], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'job not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderType  $OrderType
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
            $order_type = new OrderType;
            $order_type->id = $request->input('id');
            $order_type = OrderType::findOrFail($order_type->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'OrderType Not Find!', 'order_type_id' => $order_type->id, 'error' => $e], 409);
        }
        try {
            $order_type->name = $request->input('name');

            $order_type->save();

            //return successful response
            return response()->json(['order_type' => $order_type, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'OrderType Update Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderType  $OrderType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $order_type = OrderType::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'OrderType Not Find!', 'order_type' => $id, 'error' => $e], 409);
        }
        try {
            $order_type->delete();
            return response()->json(['order_type' => $order_type, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'OrderType Delete Failed!', 'error' => $e], 409);
        }
    }
}
