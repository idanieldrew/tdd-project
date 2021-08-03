<?php

namespace Tests\Feature;

use App\Models\Totourial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TotourialTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_guest_can_not_create_a_post()
    {
        $user = User::factory()->create();

        $attribute = [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
        ];

        $this->get(route('totourial.create'))->assertRedirect('login');

        $this->post(route('totourial.store'), $attribute)->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_post()
    {
        $this->Login();

        $attribute = [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
        ];

        $this->post(route('totourial.store'), $attribute);

        $this->assertDatabaseHas('totourials', $attribute);
    }

    /** @test */
    public function a_title_is_required()
    {
        $this->Login();

        $attributes = Totourial::factory()->raw(['title' => []]);


        $this->post(route('totourial.store'), $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_body_is_required()
    {
        $this->Login();

        $attributes = Totourial::factory()->raw(['body' => []]);

        $this->post(route('totourial.store'), $attributes)->assertSessionHasErrors('body');
    }

    /** @est */
    public function a_totourial_has_a_owner()
    {
        $this->Login();

        $attributes = Totourial::factory()->raw(['user_id' => []]);

        $this->post(route('totourial.store'), $attributes)->assertSessionHasErrors('user_id');
    }

    /** @test */
    public function page_of_special_post()
    {
        $this->Login();
        $totourial = Totourial::factory()->create();

        $this->get(route('totourial.show', $totourial->id))
            ->assertSee($totourial->body);
    }

    /** @test */
    public function a_totourial_can_update()
    {
        $this->Login();

        $totourial = Totourial::factory()->create(['user_id' => auth()->user()->id]);

        $attributes = [
            'title' => 'changed',
            'body' => 'changed'
        ];

        $this->get(route('totourial.edit', $totourial->id))->assertSee('Edit Totourials');

        $this->patch(route('totourial.update', $totourial->id), $attributes);

        $this->assertDatabaseHas('totourials', $attributes);
    }

    /** @test */
    public function a_tips_can_update_in_totourial()
    {
        $this->withoutExceptionHandling();
        $this->Login();

        $totourial = Totourial::factory()->create(['user_id' => auth()->user()->id]);

        $attribute = [
            'tips' => 'changed'
        ];

        $this->patch(route('totourial.update', $totourial->id), $attribute);

        $this->assertDatabaseHas('totourials', $attribute);
    }

}
