<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //创建Comment伪造规则
        $this->faker = \Faker\Factory::create('zh_CN');
        return [
            'user_id' => 1,
            'post_id' => 2,
            'parent_id' => null,
            'content' => $this->faker->paragraph,
        ];
    }
}
