<?php

namespace Database\Factories;

use App\Models\Comment;
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
        return [
            'user' => fake()->name(),
            'message' => fake()->text(),
        ];
    }

    function configure(): static
    {
        return $this->afterCreating(function (Comment $comment) {
            if ($comment->level < 3) {
                $repliesAmmount = fake()->numberBetween(1, 3);
                Comment::factory($repliesAmmount)->create([
                    'level' => $comment->level + 1,
                    'parent_id' => $comment->id,
                ]);
            }
        });
    }
}
