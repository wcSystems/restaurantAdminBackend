<?php

namespace App\Http\Controllers;

use App\OrderRestriction;
use Illuminate\Http\Request;

class OrderRestrictionController extends Controller
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
        return response()->json(['order_restrictions' =>  OrderRestriction::all()], 200);
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

            $order_restriction = new OrderRestriction;
            $order_restriction->name = $request->input('name');

            $order_restriction->save();

            //return successful response
            return response()->json(['order_restriction' => $order_restriction, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'OrderRestriction Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderRestriction  $order_restriction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $order_restriction = OrderRestriction::findOrFail($id);

            return response()->json(['order_restriction' => $order_restriction], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'OrderRestriction not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderRestriction  $order_restriction
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
            $order_restriction = new OrderRestriction;
            $order_restriction->id = $request->input('id');
            $order_restriction = OrderRestriction::findOrFail($order_restriction->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'OrderRestriction Not Find!', 'order_restriction_id' => $order_restriction->id, 'error' => $e], 409);
        }
        try {
            $order_restriction->name = $request->input('name');

            $order_restriction->save();

            //return successful response
            return response()->json(['order_restriction' => $order_restriction, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'OrderRestriction Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderRestriction  $order_restriction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $order_restriction = OrderRestriction::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'OrderRestriction Not Find!', 'order_restriction_id' => $id, 'error' => $e], 409);
        }
        try {
            $order_restriction->delete();
            return response()->json(['order_restriction' => $order_restriction, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'OrderRestriction Delete Failed!', 'error' => $e], 409);
        }
    }
}
