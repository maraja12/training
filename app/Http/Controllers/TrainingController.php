<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Coach;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Http\Resources\TrainingCollection;
use App\Http\Resources\TrainingResource;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $trainings = Training::all();
        return response()->json(new TrainingCollection($trainings));
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
            'name' =>  'required|string|max:255',
            'level' =>  'required|in:low,medium,high',
            'gender' =>  'required|in:male,female',
            'coach_id' =>  'required|integer|max:255',
            'equipment_id' =>  'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $equipment = Equipment::find($request->equipment_id);
        if (is_null($equipment)) {
            return response()->json('Equipment is not found', 404);
        }

        $coach = Coach::find($request->coach_id);
        if (is_null($coach)) {
            return response()->json('Coach is not found', 404);
        }

        $training = Training::create([
            'name' => $request->name,
            'level' => $request->level,
            'gender' => $request->gender,
            'coach_id' => $request->coach_id,
            'equipment_id' => $request->equipment_id,
        ]);

        return response()->json([
            'Training is successfully created' => new TrainingResource($training)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show($training_id)
    {
        //
        $training = Training::find($training_id);
        if (is_null($training)) {
            return response()->json('Training is not found', 404);
        }
        return response()->json(new TrainingResource($training));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Training $training)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' =>  'required|string|max:255',
            'level' =>  'required|in:low,medium,high',
            'gender' =>  'required|in:male,female',
            'coach_id' =>  'required|integer|max:255',
            'equipment_id' =>  'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $equipment = Equipment::find($request->equipment_id);
        if (is_null($equipment)) {
            return response()->json('Equipment is not found', 404);
        }

        $coach = Coach::find($request->coach_id);
        if (is_null($coach)) {
            return response()->json('Coach is not found', 404);
        }

        $training->name = $request->name;
        $training->level = $request->level;
        $training->gender = $request->gender;
        $training->coach_id = $request->coach_id;
        $training->equipment_id = $request->equipment_id;

        $training->save();

        return response()->json([
            'Training is successfully updated' => new TrainingResource($training)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        //
        $training->delete();

        return response()->json('Training is successfully deleted');
    }
}
