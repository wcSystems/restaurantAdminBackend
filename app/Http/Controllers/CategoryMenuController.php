<?php

namespace App\Http\Controllers;

use App\CategoryMenu;
use Illuminate\Http\Request;

class CategoryMenuController extends Controller
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
        return response()->json(['category_menu' =>  CategoryMenu::all()], 200);
    }

    public function sub_category(Request $request)
    {
        try {
            $category_menu_id = $request->input('category_menu_id');

            $category_menu = CategoryMenu::where('category_menu_id', $category_menu_id)->get();

            return response()->json(['category_menu' =>  $category_menu], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'SubCategoryMenu not found!'], 404);
        }
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

            $category_menu = new CategoryMenu;
            $category_menu->name = $request->input('name');
            $category_menu->image = $request->input('image');
            $category_menu->description = $request->input('description');
            $category_menu->category_menu_id = $request->input('category_menu_id');

            $category_menu->save();

            //return successful response
            return response()->json(['category_menu' => $category_menu, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'CategoryMenu Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoryMenu  $categoryMenu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $category_menu = CategoryMenu::findOrFail($id);

            return response()->json(['category_menu' => $category_menu], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'xxxCategoryMenu not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoryMenu  $categoryMenu
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
            $category_menu = new CategoryMenu;
            $category_menu->id = $request->input('id');
            $category_menu = CategoryMenu::findOrFail($category_menu->id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'CategoryMenu Not Find!', 'category_menu_id' => $category_menu->id, 'error' => $e], 409);
        }
        try {
            $category_menu->name = $request->input('name');
            $category_menu->image = $request->input('image');
            $category_menu->description = $request->input('description');
            $category_menu->category_menu_id = $request->input('category_menu_id');

            $category_menu->save();

            //return successful response
            return response()->json(['category_menu' => $category_menu, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'CategoryMenu Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoryMenu  $categoryMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category_menu = CategoryMenu::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'CategoryMenu Not Find!', 'category_menu_id' => $id, 'error' => $e], 409);
        }
        try {
            $category_menu->delete();
            return response()->json(['category_menu' => $category_menu, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'CategoryMenu Delete Failed!', 'error' => $e], 409);
        }
    }

    public function menus(Request $request)
    {
        try {
            $id = $request->input('id');

            $rest_menu = CategoryMenu::findOrFail($id)->rest_menus()->get();

            return response()->json(['rest_menu' =>  $rest_menu], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'RestMenu not found!'], 404);
        }
    }
}
