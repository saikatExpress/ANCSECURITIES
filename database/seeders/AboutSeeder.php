<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\About;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now      = Carbon::now();

        About::insert([
            [
                'id'         => 1,
                'title'       => 'ANC Securities Ltd is dedicated to safeguarding your assets and ensuring peace of mind. With a focus on cutting-edge technology and meticulous attention to detail, we provide comprehensive security solutions tailored to your specific needs.',
                'block_quote'      => "Security is not just a product, but a process.
                        It's more than designing strong walls; it's about creating a culture of vigilance,
                        resilience, and continuous improvement. In the realm of security, there are no shortcuts;
                        only unwavering commitment to protecting what matters most.",
                'description'     => 'ANC Securities Ltd is dedicated to safeguarding your assets and ensuring peace of mind.
                        With a focus on cutting-edge technology and meticulous attention to detail, we provide comprehensive security
                        solutions tailored to your specific needs.',
                'created_by'   => 'ANC ADMIN',
                'created_at' => $now,
            ],
        ]);
    }
}
