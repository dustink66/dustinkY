<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //创建Category伪造规则
        $this->faker = \Faker\Factory::create('zh_CN');
        return [
            'title' => $this->faker->sentence,
            'parent_id' => null,
            'description' => $this->faker->paragraph,
            'user_id' => null,
            '_lft' => 1,
            '_rgt' => 2,
        ];
    }
}
