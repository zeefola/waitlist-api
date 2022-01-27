<?php

namespace Database\Factories;

use App\Models\WaitLister;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WaitListerFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WaitLister::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fullname' => $this->faker->name,
            'email' => 'fola@gmail.com',
            'type' => 'investor',
        ];
    }
}