<?php

use App\Profession;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profession::create([
            'title' => 'Desarrollador Back-End',
            'created_at' => now()->subDays(rand(1,90)),
        ]);
        Profession::create([
            'title' => 'Desarrollador Front-End',
            'created_at' => now()->subDays(rand(1,90)),
        ]);
        Profession::create([
            'title' => 'Diseñador Web',
            'created_at' => now()->subDays(rand(1,90)),
        ]);

        factory(Profession::class, 7)->create([
            'created_at' => now()->subDays(rand(1,90)),
        ]);
    }
}
