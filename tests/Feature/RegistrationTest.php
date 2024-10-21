<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegistrationTest extends TestCase
{

    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function a_user_can_register_with_valid_data()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('dashboard', absolute: false));
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com'
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function registration_requires_name_email_password()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function password_must_be_confirmed()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function email_must_be_unique()
    {
        
        User::factory()->create([
            'email' => 'test@example.com',
        ]);

       
        $response = $this->post('/register', [
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        
        $response->assertSessionHasErrors(['email']);
    }
}
