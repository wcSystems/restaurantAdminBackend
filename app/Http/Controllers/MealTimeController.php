<?php

namespace App\Http\Controllers;

use App\MealTime;
use Illuminate\Http\Request;

class MealTimeController extends Controller
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
        return response()->json(['meal_times' =>  MealTime::all()], 200);
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

            $meal_time = new MealTime;
            $meal_time->name = $request->input('name');
            $meal_time->start_time = $request->input('start_time');
            $meal_time->end_time = $request->input('end_time');
            $meal_time->status = true;

            $meal_time->save();

            //return successful response
            return response()->json(['meal_time' => $meal_time, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'MealTime Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MealTime  $meal_time
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $meal_time = MealTime::findOrFail($id);

            return response()->json(['meal_time' => $meal_time], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'MealTime not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MealTime  $meal_time
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required|string',
            'status' => 'required',
        ]);

        try {
            $meal_time = new MealTime;
            $meal_time->id = $request->input('id');
            $meal_time = MealTime::findOrFail($meal_time->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'MealTime Not Find!', 'meal_time_id' => $meal_time->id, 'error' => $e], 409);
        }
        try {
            $meal_time->name = $request->input('name');
            $meal_time->start_time = $request->input('start_time');
            $meal_time->end_time = $request->input('end_time');
            $meal_time->status = $request->input('status');

            $meal_time->save();

            //return successful response
            return response()->json(['meal_time' => $meal_time, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'MealTime Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MealTime  $meal_time
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $meal_time = MealTime::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'MealTime Not Find!', 'meal_time_id' => $id, 'error' => $e], 409);
        }
        try {
            $meal_time->delete();
            return response()->json(['meal_time' => $meal_time, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'MealTime Delete Failed!', 'error' => $e], 409);
        }
    }
}
