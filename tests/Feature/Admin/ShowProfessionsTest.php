<?php

namespace Tests\Feature\Admin;

use App\Profession;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowProfesisonsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_profession_details()
    {
        $profession = factory(Profession::class)->create([
            'title' => 'profession_test',
        ]);

        $this->get('profesiones/' . $profession->id)
            ->assertStatus(200)
            ->assertSee($profession->title);
    }

    /** @test */
    public function it_displays_a_404_error_if_the_profession_is_not_found()
    {
        $this->withExceptionHandling();

        $this->get('profesiones/999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
    }
}
