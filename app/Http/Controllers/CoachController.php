<?php

namespace App\Http\Controllers;

use App\Http\Resources\CoachCollection;
use App\Http\Resources\CoachResource;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $coaches = Coach::all();
        return response()->json(new CoachCollection($coaches));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:coaches',
            'age' => 'required|integer|between:18,65',
            'experience' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $coach = Coach::create([
            'name' => $request->name,
            'age' => $request->age,
            'experience' => $request->experience,
        ]);

        return response()->json([
            'Coach is created' => new CoachResource($coach)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function show($coach_id)
    {
        //
        $coach = Coach::find($coach_id);
        if (is_null($coach)) {
            return response()->json('Coach is not found', 404);
        }
        return response()->json(new CoachResource($coach));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function edit(Coach $coach)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coach $coach)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:coaches',
            'age' => 'required|integer|between:18,65',
            'experience' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $coach->name = $request->name;
        $coach->age = $request->age;
        $coach->experience = $request->experience;

        $coach->save();

        return response()->json([
            'Coach is updated' => new CoachResource($coach)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coach $coach)
    {
        //
        $coach->delete();

        return response()->json('Coach is deleted');
    }
}
