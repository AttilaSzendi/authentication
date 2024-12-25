<?php


 use App\Models\User;
 use Illuminate\Foundation\Testing\RefreshDatabase;
 use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;
 use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_user_cannot_log_out(): void
    {
        $response = $this->getJson(route('logout'));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_user_can_log_out(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $token = $user->createToken('TestToken');

        $response = $this->getJson(route('logout'), [
            'Authorization' => 'Bearer ' . $token->plainTextToken,
        ]);

        $response->assertOk();

        $this->assertDatabaseMissing('personal_access_tokens', [
            'id' => $token->accessToken->id,
        ]);
    }
}