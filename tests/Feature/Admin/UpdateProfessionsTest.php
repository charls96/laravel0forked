<?php

namespace Tests\Feature\Admin;

use App\Profession;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateProfessionsTest extends TestCase
{
    use RefreshDatabase;

    protected $defaultData = [
        'title' => 'profession_test'
    ];

    /** @test */
    public function it_loads_the_edit_profession_page()
    {
        $profession = factory(Profession::class)->create();

        $this->get('profesiones/' . $profession->id . '/editar')
            ->assertStatus(200)
            ->assertViewIs('professions.edit')
            ->assertSee('Editar profesión')
            ->assertViewHas('profession', function ($viewProfession) use ($profession) {
                return $viewProfession->id === $profession->id;
            });
    }

    /** @test */
    public function it_updates_a_profession()
    {
        $profession = factory(Profession::class)->create();

        $this->put('profesiones/' . $profession->id, $this->withData([
            'title' => 'profession_updated'
        ]))->assertRedirect('profesiones/' . $profession->id);

        $this->assertDatabaseHas('professions', [
            'title' => 'profession_updated'
        ]);
    }

    /** @test */
    public function the_profession_title_is_required()
    {
        $this->handleValidationExceptions();

        $profession = factory(Profession::class)->create();

        $this->from('profesiones/' . $profession->id . '/editar')
            ->put('profesiones/' . $profession->id, $this->withData([
                'title' => '',
            ]))->assertRedirect('profesiones/' . $profession->id . '/editar')
            ->assertSessionHasErrors(['title']);
    }
}
