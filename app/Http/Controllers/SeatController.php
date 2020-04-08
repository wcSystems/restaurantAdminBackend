<?php

namespace App\Http\Controllers;

use App\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
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
        return response()->json(['seat' =>  Seat::all()], 200);
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
            'name' => 'required',
            'table_id' => 'required'
        ]);

        try {

            for ($i = 1; $i <= $request->input('name'); $i++) {
                $seat = new Seat;
                $seat->name = $i;
                $seat->table_id = $request->input('table_id');
                $seat->status = true;
                $seat->save();
            }

            //return successful response
            return response()->json(['seat' => $seat, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Seat Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $seat = Seat::findOrFail($id);

            return response()->json(['seat' => $seat], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'seat not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'table_id' => 'required'
        ]);
        if($request->input('seat_id')){
            foreach ($request->input('seat_id') as $key => $value) {
                Seat::Find($value['id'])->delete();
            }
            for ($i = 1; $i <= $request->input('name'); $i++) {
                $seat = new Seat;
                $seat->name = $i;
                $seat->table_id = $request->input('table_id');
                $seat->status = true;
                $seat->save();
            }
            return response()->json(['seat' => $seat, 'message' => 'UPDATE'], 201);
        }else{
            try {
                $seat = new Seat;
                $seat->id = $request->input('id');
                $seat = Seat::findOrFail($seat->id);
            } catch (\Exception $e) {
                //return error message
                return response()->json(['message' => 'Seat Not Find!', 'seat_id' => $seat->id, 'error' => $e], 409);
            }
            try {

                $seat->name = $request->input('name');
                $seat->table_id = $request->input('table_id');
                $seat->status = $request->input('status');
                $seat->save();

                //return successful response
                return response()->json(['seat' => $seat, 'message' => 'UPDATE'], 201);
            } catch (\Exception $e) {
                //return error message
                return response()->json(['message' => 'Seat Updte Failed!', 'error' => $e], 409);
            }
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $seat = Seat::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Seat Not Find!', 'seat_id' => $id, 'error' => $e], 409);
        }
        try {
            $seat->delete();
            return response()->json(['seat' => $seat, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Seat Delete Failed!', 'error' => $e], 409);
        }
    }
}
