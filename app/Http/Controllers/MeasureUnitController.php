<?php

namespace App\Http\Controllers;

use App\MeasureUnit;
use Illuminate\Http\Request;

class MeasureUnitController extends Controller
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
        return response()->json(['measure_units' =>  MeasureUnit::all()], 200);
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

            $measure_unit = new MeasureUnit;
            $measure_unit->name = $request->input('name');

            $measure_unit->save();

            //return successful response
            return response()->json(['measure_unit' => $measure_unit, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'MeasureUnit Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MeasureUnit  $measure_unit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $measure_unit = MeasureUnit::findOrFail($id);

            return response()->json(['measure_unit' => $measure_unit], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'MeasureUnit not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MeasureUnit  $measure_unit
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
            $measure_unit = new MeasureUnit;
            $measure_unit->id = $request->input('id');
            $measure_unit = MeasureUnit::findOrFail($measure_unit->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'MeasureUnit Not Find!', 'measure_unit_id' => $measure_unit->id, 'error' => $e], 409);
        }
        try {
            $measure_unit->name = $request->input('name');

            $measure_unit->save();

            //return successful response
            return response()->json(['measure_unit' => $measure_unit, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'MeasureUnit Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MeasureUnit  $measure_unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $measure_unit = MeasureUnit::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'MeasureUnit Not Find!', 'measure_unit_id' => $id, 'error' => $e], 409);
        }
        try {
            $measure_unit->delete();
            return response()->json(['measure_unit' => $measure_unit, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'MeasureUnit Delete Failed!', 'error' => $e], 409);
        }
    }
}
