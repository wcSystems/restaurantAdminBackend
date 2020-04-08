<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;

class TableController extends Controller
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
        return response()->json(['tables' =>  Table::all()], 200);
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

            $table = new Table;
            $table->name = $request->input('name');
            $table->status = true;

            $table->save();

            //return successful response
            return response()->json(['table' => $table, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Table Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $table = Table::findOrFail($id);

            return response()->json(['table' => $table], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'table not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Table  $table
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
            $table = new Table;
            $table->id = $request->input('id');
            $table = Table::findOrFail($request->input('id'));

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Table Not Find!', 'table_id' => $table->id, 'error' => $e], 409);
        }
        try {
            $table->name = $request->input('name');
            $table->status = $request->input('status');

            $table->save();

            //return successful response
            return response()->json(['table' => $table, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Table Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $table = Table::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Table Not Find!', 'table_id' => $id, 'error' => $e], 409);
        }
        try {
            $table->delete();
            return response()->json(['table' => $table, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Table Delete Failed!', 'error' => $e], 409);
        }
    }

    public function get_tablesBySalesOrders()
    {
        $tables = Table::where('status', true)->get();
        $array = [];
        foreach ($tables as $key => $value) {
            $value['sale_orders'] = Table::Find($value->id)->sale_orders()->where('status_order_id','!=',2)->get();
            array_push($array,$value);
        };
        return response()->json(['tables' =>  $array], 200);
    }
}
