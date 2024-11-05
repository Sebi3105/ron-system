<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition()
    {
        return [
            'brand_name' => $this->faker->company, // Sample data
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
