<?php

namespace Tests\Feature;

use App\Models\Totourial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TotourialTest extends TestCase
{

    use WithFaker,RefreshDatabase;

    /** @test */
    public function a_guest_can_not_create_a_post()
    {
        $user = User::factory()->create();

        $attribute = [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
        ];

        $this->get(route('totourial.create'))->assertRedirect('login');

        $this->post(route('totourial.store'),$attribute)->assertRedirect('login');
    }

     /** @test */
     public function a_user_can_create_a_post()
     {
         $this->Login();
 
         $attribute = [
             'title' => $this->faker->sentence(),
             'body' => $this->faker->paragraph(),
             'user_id' => auth()->user()->id
         ];
 
         $this->post(route('totourial.store'),$attribute);
 
         $this->assertDatabaseHas('totourials', $attribute);
 
      /*   $this->get('/posts')
             ->assertSee($attribute['title'])
             ->assertSee($attribute['body']);*/
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

    /** @test */
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
 
}
