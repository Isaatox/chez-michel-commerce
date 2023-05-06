<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $user = \App\Models\User::factory()->create([
            'prenom' => 'John',
            'nom' => 'Doe',
            'email' => 'j.doe@example.com',
            'password' => bcrypt('Password-35340'),
            'adresse' => '52 rue de chez jean',
            'ville' => 'Rennes',
            'code_postal' => '35000',
            'civilite' => 'M.',
        ]);

        $response = $this->actingAs($user)->get(RouteServiceProvider::HOME);

        $response->assertOk();
    }

}
