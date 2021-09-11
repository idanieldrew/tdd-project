<?php

namespace Tests\Feature;

use App\Models\Totourial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InviteTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /** @test */
    public function totourial_owner_can_invite_a_user()
    {
        $this->Login();

        $totourial = Totourial::factory()->create(['user_id' => auth()->user()->id]);

        $user = User::factory()->create();

        $totourial->invite($user);

        $this->assertDatabaseHas('members_totourials', ['user_id' => $user->id]);
    }
}
