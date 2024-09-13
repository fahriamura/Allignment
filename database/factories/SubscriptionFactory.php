<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1, // Contoh user_id, bisa disesuaikan
            'plan_name' => $this->faker->word, // Contoh field 'plan'
            'level'=>2,
            'started_at' => now(),
            'ended_at' => now()->addYear(),
        ];
    }
}
