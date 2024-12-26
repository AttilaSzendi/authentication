<?php


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_cannot_register(): void
    {
        $response = $this->postJson(route('register'));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_guest_user_can_register(): void
    {
        $input = [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson(route('register'), $input);

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@test.com',
        ]);

        $user = User::query()->first();

        $this->assertTrue(Hash::check('password', $user->password));

        $response->assertStatus(Response::HTTP_CREATED);
    }
}
