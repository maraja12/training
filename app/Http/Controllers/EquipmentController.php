<?php

namespace App\Http\Controllers;

use App\Http\Resources\EquipmentCollection;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $equipments = Equipment::all();
        return response()->json(new EquipmentCollection($equipments));
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
            'weight' => 'required|integer|between:0,100',
            'storage' => 'required|integer|between:1,20',
            'usage' => 'required|in:legs,shoulders,back,abs.gluteus',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $equipment = Equipment::create([
            'weight' => $request->weight,
            'storage' => $request->storage,
            'usage' => $request->usage,
        ]);

        return response()->json([
            'Equipment is created' => new EquipmentResource($equipment)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show($equipment_id)
    {
        //
        $equipment = Equipment::find($equipment_id);
        if (is_null($equipment)) {
            return response()->json('Equipment is not found', 404);
        }
        return response()->json(new EquipmentResource($equipment));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        //
        $validator = Validator::make($request->all(), [
            'weight' => 'required|integer|between:0,100',
            'storage' => 'required|integer|between:1,20',
            'usage' => 'required|in:legs,shoulders,back,abs.gluteus',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $equipment->weight = $request->weight;
        $equipment->storage = $request->storage;
        $equipment->usage = $request->usage;

        $equipment->save();

        return response()->json([
            'Equipment has been updated' => new EquipmentResource($equipment)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        //
        $equipment->delete();

        return response()->json('Equipment is deleted');
    }
}
