<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\CycleAvailability;
use App\Models\CycleInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CycleControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase; // reset DB between tests
    public function user_can_register_a_cycle_with_images_and_hours(): void
    {
        // 1. Fake a user
        $user = User::factory()->create();

        // 2. Fake an image upload
        $file = \Illuminate\Http\UploadedFile::fake()->image('cycle.jpg');

        // 3. Acting as user, send a POST request to your route
        $response = $this->actingAs($user)->post('/add-cycle', [
            'cycle_brand_name'     => 'Giant',
            'cycle_type'           => 'Mountain Bike',
            'cycle_model'          => 'X200',
            'cycle_sku'            => 'SKU123',
            'cycle_description'    => 'Strong mountain cycle',
            'cycle_available_date' => now()->format('d F, Y'),
            'cycle_available_from' => '08:00',
            'cycle_available_to'   => '12:00',
            'cycle_images'         => [$file],
        ]);

        // 4. Assert redirect and success message
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Your Cycle Has Been Registered !!!');

        // 5. Check DB has cycle info
        $this->assertDatabaseHas('cycle_infos', [
            'brand' => 'Giant',
            'owner_id' => $user->id,
        ]);

        // 6. Check DB has cycle availability
        $this->assertDatabaseHas('cycle_availabilities', [
            'owner_id' => $user->id,
        ]);
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
    }
}
