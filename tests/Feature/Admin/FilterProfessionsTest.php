<?php

namespace Tests\Feature\Admin;

use App\Profession;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilterProfessionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function filter_professions_created_from_date()
    {
        $newestProfession = factory(Profession::class)->create([
            'created_at' => '2018-10-02 12:00:00',
        ]);

        $oldestProfession = factory(Profession::class)->create([
            'created_at' => '2018-09-29 12:00:00',
        ]);

        $newProfession = factory(Profession::class)->create([
            'created_at' => '2018-10-01 00:00:00',
        ]);

        $oldProfession = factory(Profession::class)->create([
            'created_at' => '2018-09-30 23:59:59',
        ]);

        $response = $this->get('profesiones?from=01/10/2018');

        $response->assertOk();

        $response->assertViewCollection('professions')
            ->contains($newProfession)
            ->contains($newestProfession)
            ->notContains($oldProfession)
            ->notContains($oldestProfession);
    }

    /** @test */
    public function filter_professions_created_to_date()
    {
        $newestProfession = factory(Profession::class)->create([
            'created_at' => '2018-10-02 12:00:00',
        ]);

        $oldestProfession = factory(Profession::class)->create([
            'created_at' => '2018-09-29 12:00:00',
        ]);

        $newProfession = factory(Profession::class)->create([
            'created_at' => '2018-10-01 00:00:00',
        ]);

        $oldProfession = factory(Profession::class)->create([
            'created_at' => '2018-09-30 23:59:59',
        ]);

        $response = $this->get('profesiones?to=30/09/2018');

        $response->assertOk();

        $response->assertViewCollection('professions')
            ->contains($oldestProfession)
            ->contains($oldProfession)
            ->notContains($newestProfession)
            ->notContains($newProfession);
    }

}



