<?php


use App\Models\RealEstate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RealEstateIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_real_estates_can_be_retrieved(): void
    {
        RealEstate::factory()->count($count = 3)->create();

        $response = $this->getJson(route('realEstate.index'));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonStructure([
            'data' => [
                [
                    'address',
                    'city',
                    'country',
                    'photo',
                    'availableUnits',
                    'wifi',
                    'laundry'
                ]
            ]
        ]);

        $response->assertJsonCount($count, 'data');
    }
}
