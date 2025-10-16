<?php

namespace Tests\Feature;

use App\Models\CycleAvailability;
use App\Models\CycleInfo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReserveCycleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function user_cannot_reserve_hours_without_selecting_any()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/cycle_info/reserve_available_hours_form', [
            'available_date' => now()->format('Y-m-d'),
            'reserve_available_hours_ids' => [], // empty
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Please select available Hours !!!');
    }

    /** @test */
    public function user_can_reserve_selected_hours()
    {
        $user = User::factory()->create();

        // Create a cycle info + availability
        $cycle = CycleInfo::factory()->create(['owner_id' => $user->id]);

        $availability = CycleAvailability::factory()->create([
            'cycle_id' => $cycle->id,
            'owner_id' => $user->id,
            'available_date' => now()->format('Y-m-d H:i:s'),
            'available_hours' => '10:00',
            'cycle_availability_status_id' => 1, // available
        ]);

        $response = $this->actingAs($user)->post('/cycle_info/reserve_available_hours_form', [
            'available_date' => now()->format('Y-m-d'),
            'reserve_available_hours_ids' => [$availability->id],
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'You Reserved Your Hours !!!');

        // Assert DB updated
        $this->assertDatabaseHas('cycle_availabilities', [
            'id' => $availability->id,
            'cycle_availability_status_id' => 2, // reserved
            'user_id' => $user->id,
        ]);
    }
}
