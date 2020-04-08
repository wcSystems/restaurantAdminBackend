<?php

namespace App\Http\Controllers;

use App\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
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
        return response()->json(['category_products' =>  CategoryProduct::all()], 200);
    }

    public function sub_category(Request $request)
    {
        try {
            $category_product_id = $request->input('category_product_id');

            $category_product = CategoryProduct::where('category_product_id', $category_product_id)->get();

            return response()->json(['category_product' =>  $category_product], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'SubCategoryProduct not found!'], 404);
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

            $category_product = new CategoryProduct;
            $category_product->name = $request->input('name');
            $category_product->category_product_id = $request->input('category_product_id');
            $category_product->save();

            //return successful response
            return response()->json(['category_product' => $category_product, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'CategoryProduct Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoryProduct  $category_product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $category_product = CategoryProduct::findOrFail($id);

            return response()->json(['category_product' => $category_product], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'CategoryProduct not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoryProduct  $category_product
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
            $category_product = new CategoryProduct;
            $category_product->id = $request->input('id');
            $category_product = CategoryProduct::findOrFail($category_product->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'CategoryProduct Not Find!', 'category_product_id' => $category_product->id, 'error' => $e], 409);
        }
        try {
            $category_product->name = $request->input('name');
            $category_product->category_product_id = $request->input('category_product_id');
            $category_product->save();

            //return successful response
            return response()->json(['category_product' => $category_product, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'CategoryProduct Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoryProduct  $category_product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category_product = CategoryProduct::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'CategoryProduct Not Find!', 'category_product_id' => $id, 'error' => $e], 409);
        }
        try {
            $category_product->delete();
            return response()->json(['category_product' => $category_product, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'CategoryProduct Delete Failed!', 'error' => $e], 409);
        }
    }

    public function products(Request $request)
    {
        try {
            $id = $request->input('id');

            $category_product = CategoryProduct::findOrFail($id)->products()->get();

            return response()->json(['category_product' =>  $category_product], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'CategoryProduct not found!'], 404);
        }
    }
}
