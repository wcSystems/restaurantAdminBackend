<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
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
        return response()->json(['providers' =>  Provider::all()], 200);
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

            $provider = new Provider;
            $provider->name = $request->input('name');
            $provider->phone = $request->input('phone');
            $provider->address = $request->input('address');
            $provider->rif = $request->input('rif');
            $provider->email = $request->input('email');

            $provider->save();

            //return successful response
            return response()->json(['provider' => $provider, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Provider Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $provider = Provider::findOrFail($id);

            return response()->json(['provider' => $provider], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Provider not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
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
            $provider = new Provider;
            $provider->id = $request->input('id');
            $provider = Provider::findOrFail($provider->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Provider Not Find!', 'provider_id' => $provider->id, 'error' => $e], 409);
        }
        try {
            $provider->name = $request->input('name');
            $provider->phone = $request->input('phone');
            $provider->address = $request->input('address');
            $provider->rif = $request->input('rif');
            $provider->email = $request->input('email');

            $provider->save();

            //return successful response
            return response()->json(['provider' => $provider, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Provider Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $provider = Provider::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Provider Not Find!', 'provider_id' => $id, 'error' => $e], 409);
        }
        try {
            $provider->delete();
            return response()->json(['provider' => $provider, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Provider Delete Failed!', 'error' => $e], 409);
        }
    }

    public function searchByName($name)
    {
        try {
            $provider = Provider::where('name', 'LIKE', "{$name}%")
                ->orWhere('rif', 'LIKE', "{$name}%")
                ->orWhere('address', 'LIKE', "{$name}%")
                ->get();

            return response()->json(['provider' => $provider], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Provider not found!'], 404);
        }
    }
}
