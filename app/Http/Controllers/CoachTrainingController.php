<?php

namespace App\Http\Controllers;

use App\Http\Resources\TrainingCollection;
use App\Models\Training;
use App\Models\Coach;
use Illuminate\Http\Request;


class CoachTrainingController extends Controller
{
    //
    public function index($coach_id)
    {
        $coach = Coach::find($coach_id);
        if (is_null($coach)) {
            return response()->json('Caoch is not found', 404);
        }

        $trainings = Training::get()->where('coach_id', $coach_id);
        if (is_null($trainings)) {
            return response()->json('Trainings are not found', 404);
        }

        return response()->json([
            'coach' => $coach->name,
            'trainings' => new TrainingCollection($trainings)
        ]);
    }
}
