<?php

namespace Tests\Feature;

 use App\Models\User;
 use Illuminate\Foundation\Testing\RefreshDatabase;
 use Illuminate\Support\Facades\Hash;
 use Symfony\Component\HttpFoundation\Response;
 use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_log_in_with_invalid_credentials(): void
    {
        $password = 'password';

        $user = User::factory()->create(['password' => Hash::make($password)]);

        $input = [
            'email' => $user->email,
            'password' => 'wrong_password',
        ];

        $response = $this->getJson(route('login', $input));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
        ]);

        $this->assertGuest();
    }

    public function test_user_can_log_in_by_requiring_a_token(): void
    {
        $password = 'password';

        $user = User::factory()->create(['password' => Hash::make($password)]);

        $input = [
            'email' => $user->email,
            'password' => $password,
        ];

        $response = $this->getJson(route('login', $input));

        $response->assertOk();

        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_id' => $user->id,
        ]);

        $this->assertAuthenticatedAs($user);
    }
}
