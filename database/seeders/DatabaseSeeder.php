<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Training;
use App\Models\Equipment;
use App\Models\Coach;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::truncate();
        Coach::truncate();
        Equipment::truncate();
        Training::truncate();

        User::factory(3)->create();

        $coach1 = Coach::factory()->create();
        $coach2 = Coach::factory()->create();
        $coach3 = Coach::factory()->create();

        $equipment1 = Equipment::factory()->create();
        $equipment2 = Equipment::factory()->create();
        $equipment3 = Equipment::factory()->create();

        Training::factory()->create([
            'coach_id' => $coach1->id,
            'equipment_id' => $equipment1->id
        ]);
        Training::factory()->create([
            'coach_id' => $coach1->id,
            'equipment_id' => $equipment2->id
        ]);
        Training::factory()->create([
            'coach_id' => $coach1->id,
            'equipment_id' => $equipment3->id
        ]);
        Training::factory()->create([
            'coach_id' => $coach2->id,
            'equipment_id' => $equipment1->id
        ]);
        Training::factory()->create([
            'coach_id' => $coach2->id,
            'equipment_id' => $equipment2->id
        ]);
        Training::factory()->create([
            'coach_id' => $coach2->id,
            'equipment_id' => $equipment3->id
        ]);
        Training::factory()->create([
            'coach_id' => $coach3->id,
            'equipment_id' => $equipment1->id
        ]);
        Training::factory()->create([
            'coach_id' => $coach3->id,
            'equipment_id' => $equipment2->id
        ]);
        Training::factory()->create([
            'coach_id' => $coach3->id,
            'equipment_id' => $equipment3->id
        ]);
    }
}
