<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        return response()->json(['products' =>  Product::all()], 200);
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
            'category_product_id' => 'required',
            'measure_unit_id' => 'required'
        ]);

        try {

            $product = new Product;
            $product->name = $request->input('name');
            $product->category_product_id = $request->input('category_product_id');
            $product->description = $request->input('description');
            $product->measure_unit_id = $request->input('measure_unit_id');
            $product->conversion_factor = $request->input('conversion_factor');
            $product->depletion_factor = $request->input('depletion_factor');
            $product->purchase_value = $request->input('purchase_value');
            $product->stock_quantity = $request->input('stock_quantity');
            $product->min_quantity = $request->input('min_quantity');
            $product->max_quantity = $request->input('max_quantity');

            $product->save();

            //return successful response
            return response()->json(['product' => $product, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Product Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);

            return response()->json(['product' => $product], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Product not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required|string',
            'category_product_id' => 'required',
            'measure_unit_id' => 'required'
        ]);

        try {
            $product = new Product;
            $product->id = $request->input('id');
            $product = Product::findOrFail($product->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Product Not Find!', 'product_id' => $product->id, 'error' => $e], 409);
        }
        try {
            $product->name = $request->input('name');
            $product->category_product_id = $request->input('category_product_id');
            $product->description = $request->input('description');
            $product->measure_unit_id = $request->input('measure_unit_id');
            $product->conversion_factor = $request->input('conversion_factor');
            $product->depletion_factor = $request->input('depletion_factor');
            $product->purchase_value = $request->input('purchase_value');
            $product->stock_quantity = $request->input('stock_quantity');
            $product->min_quantity = $request->input('min_quantity');
            $product->max_quantity = $request->input('max_quantity');

            $product->save();

            //return successful response
            return response()->json(['product' => $product, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Product Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Product Not Find!', 'product_id' => $id, 'error' => $e], 409);
        }
        try {
            $product->delete();
            return response()->json(['product' => $product, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Product Delete Failed!', 'error' => $e], 409);
        }
    }
}
