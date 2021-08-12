<?php

namespace Database\Factories;

use App\Models\Problem;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProblemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Problem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    { 
        $device = $this->faker->randomElement(['Mobile', 'Laptop', 'Desktop']);
        $brand = $device == 'Mobile' 
                            ? $this->faker->randomElement(['iPhone', 'Samsung', 'Huawei', 'Infinix', 'Tecno', 'Oppo']) 
                            : $this->faker->randomElement(['Apple', 'Samsung', 'Acer', 'HP', 'Asus', 'Razer', 'Lenovo', 'Alienware', 'Dell']) ;
        $fault = $this->faker->randomElement(['Screen Damage', "Device won't come on", 'Water Damage', 'Virus', 'Phone is locked', 'Other']);
        
        return [
            'device' => $device,
            'brand' => $brand,
            'fault' => $fault,
            'description' => $fault == 'Other' ? $this->faker->sentence(10) : ''
        ];
    }
}
