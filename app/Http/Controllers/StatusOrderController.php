<?php

namespace App\Http\Controllers;

use App\StatusOrder;
use Illuminate\Http\Request;

class StatusOrderController extends Controller
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
        return response()->json(['status_order' =>  StatusOrder::all()], 200);
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

            $status_order = new StatusOrder;
            $status_order->name = $request->input('name');

            $status_order->save();

            //return successful response
            return response()->json(['status_order' => $status_order, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'status_order Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StatusOrder  $statusOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $status_order = StatusOrder::findOrFail($id);

            return response()->json(['status_order' => $status_order], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'job not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StatusOrder  $statusOrder
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
            $status_order = new StatusOrder;
            $status_order->id = $request->input('id');
            $status_order = StatusOrder::findOrFail($status_order->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'StatusOrder Not Find!', 'order_type_id' => $status_order->id, 'error' => $e], 409);
        }
        try {
            $status_order->name = $request->input('name');

            $status_order->save();

            //return successful response
            return response()->json(['status_order' => $status_order, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'StatusOrder Update Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StatusOrder  $statusOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $status_order = StatusOrder::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'StatusOrder Not Find!', 'status_order' => $id, 'error' => $e], 409);
        }
        try {
            $status_order->delete();
            return response()->json(['status_order' => $status_order, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'StatusOrder Delete Failed!', 'error' => $e], 409);
        }
    }
}
