<?php

namespace App\Http\Controllers;

use App\Http\Resources\TrainingCollection;
use App\Models\Training;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentTrainingController extends Controller
{
    //
    public function index($equipment_id)
    {
        $equipment = Equipment::find($equipment_id);
        if (is_null($equipment)) {
            return response()->json('Equipment is not found', 404);
        }

        $trainings = Training::get()->where('equipment_id', $equipment_id);
        if (is_null($trainings)) {
            return response()->json('Trainings are not found', 404);
        }

        return response()->json([
            'equipment' => $equipment->id,
            'trainings' => new TrainingCollection($trainings)
        ]);
    }

}
