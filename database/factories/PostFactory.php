<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Like;
use App\Models\Share;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //创建Post 伪造规则
        $this->faker = \Faker\Factory::create('zh_CN');
        return [
            'uuid' => $this->faker->uuid,
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'content' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(),
            'published' => $this->faker->boolean,
            'published_at' => $this->faker->dateTime,
            'views' => $this->faker->numberBetween(0, 1000),
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->sentence,
            'meta_keywords' => $this->faker->sentence,
            'user_id' => 1,
            'category_id' => 1,
            'tag_id' => 1,
            'comment_id' => 1,
        ];
    }
}
