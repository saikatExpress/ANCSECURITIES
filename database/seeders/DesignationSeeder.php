<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Designation;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now      = Carbon::now();

        Designation::insert([
            [
                'id'         => 1,
                'name'       => 'Chairman',
                'slug'       => Str::slug('Chairman', '-'),
                'created_by' => 'ANC ADMIN',
                'status'     => 1,
                'created_at' => $now,
            ],
            [
                'id'         => 2,
                'name'       => 'Managing Director',
                'slug'       => Str::slug('Managing Director', '-'),
                'created_by' => 'ANC ADMIN',
                'status'     => 1,
                'created_at' => $now,
            ],
            [
                'id'         => 3,
                'name'       => 'Employee',
                'slug'       => Str::slug('Employee', '-'),
                'created_by' => 'ANC ADMIN',
                'status'     => 1,
                'created_at' => $now,
            ],
        ]);
    }
}
