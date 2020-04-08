<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
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
        return response()->json(['jobs' =>  Job::all()], 200);
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

            $job = new Job;
            $job->name = $request->input('name');
            $job->status = true;

            $job->save();

            //return successful response
            return response()->json(['job' => $job, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Job Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $job = Job::findOrFail($id);

            return response()->json(['job' => $job], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'job not found!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
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
            $job = new Job;
            $job->id = $request->input('id');
            $job = Job::findOrFail($job->id);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Job Not Find!', 'job_id' => $job->id, 'error' => $e], 409);
        }
        try {
            $job->name = $request->input('name');
            $job->status = $request->input('status');

            $job->save();

            //return successful response
            return response()->json(['job' => $job, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Job Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $job = Job::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Job Not Find!', 'job_id' => $id, 'error' => $e], 409);
        }
        try {
            $job->delete();
            return response()->json(['job' => $job, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Job Delete Failed!', 'error' => $e], 409);
        }
    }
}
