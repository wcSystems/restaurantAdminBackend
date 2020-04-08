<?php

namespace App\Http\Controllers;

use App\RestMenu;
use Illuminate\Http\Request;

class RestMenuController extends Controller
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
        return response()->json(['rest_menu' =>  RestMenu::all()], 200);
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
            'name' => 'required|string',
            'category_menu_id' => 'required',
            'meal_time_id' => 'required',
            'order_restriction_id' => 'required'
        ]);

        try {

            $rest_menu = new RestMenu;
            $rest_menu->name = $request->input('name');
            $rest_menu->category_menu_id = $request->input('category_menu_id');
            $rest_menu->meal_time_id = $request->input('meal_time_id');
            $rest_menu->min_quantity = $request->input('min_quantity');
            $rest_menu->stock_quantity = $request->input('stock_quantity');
            $rest_menu->order_restriction_id = $request->input('order_restriction_id');
            $rest_menu->description = $request->input('description');
            $rest_menu->price = $request->input('price');
            $rest_menu->restart_stock = $request->input('restart_stock');
            $rest_menu->image = $request->input('image');
            $rest_menu->status = true;

            $rest_menu->save();

            //return successful response
            return response()->json(['rest_menu' => $rest_menu, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'rest_menu Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RestMenu  $rest_menu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $rest_menu = RestMenu::findOrFail($id);

            return response()->json(['rest_menu' => $rest_menu], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'RestMenu not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RestMenu  $rest_menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required|string',
            'category_menu_id' => 'required',
            'meal_time_id' => 'required',
            'order_restriction_id' => 'required'
        ]);

        try {
            $rest_menu = new RestMenu;
            $rest_menu->id = $request->input('id');
            $rest_menu = RestMenu::findOrFail($rest_menu->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'RestMenu Not Find!', 'rest_menu_id' => $rest_menu->id, 'error' => $e], 409);
        }
        try {
            $rest_menu->name = $request->input('name');
            $rest_menu->category_menu_id = $request->input('category_menu_id');
            $rest_menu->meal_time_id = $request->input('meal_time_id');
            $rest_menu->min_quantity = $request->input('min_quantity');
            $rest_menu->stock_quantity = $request->input('stock_quantity');
            $rest_menu->order_restriction_id = $request->input('order_restriction_id');
            $rest_menu->description = $request->input('description');
            $rest_menu->price = $request->input('price');
            $rest_menu->restart_stock = $request->input('restart_stock');
            $rest_menu->image = $request->input('image');
            $rest_menu->status = $request->input('status');

            $rest_menu->save();

            //return successful response
            return response()->json(['rest_menu' => $rest_menu, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'RestMenu Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RestMenu  $rest_menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $rest_menu = RestMenu::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'RestMenu Not Find!', 'rest_menu_id' => $id, 'error' => $e], 409);
        }
        try {
            $rest_menu->delete();
            return response()->json(['rest_menu' => $rest_menu, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'RestMenu Delete Failed!', 'error' => $e], 409);
        }
    }
}
