<?php

namespace Database\Factories;

use App\Models\PersonalInfo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonalInfoFactory extends Factory
{

    protected $model = PersonalInfo::class;


    public function definition()
    {
        if (!User::all()->count()) {
            User::factory()->create();
        }

        return [
            'title' => ucfirst($this->faker->words(4, true)),
            'hobby' => $this->faker->word(),
            'nickname' => ucfirst($this->faker->userName()),
            'user_id' => User::all()->random()->id
        ];
    }
}
