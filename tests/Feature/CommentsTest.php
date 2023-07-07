<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_only_returns_level_1_comments_at_the_root(): void
    {
        Comment::factory(3)->create(['level' => 1]);

        $this->get('api/comments')
            ->assertJsonPath('data.0.level', 1)
            ->assertJsonPath('data.1.level', 1)
            ->assertJsonPath('data.2.level', 1);
    }

    public function test_index_returns_nested_comments(): void
    {
        Comment::factory(1)
            ->has(Comment::factory(2)->set('level', 2))
            ->create(['level' => 1]);

        $this->get('api/comments')
            ->assertJsonPath('data.0.comments.0.level', 2);
    }

    public function test_it_cannot_create_comments_with_level_higer_than_3(): void
    {
        $this->postJson('api/comments', [
            'user' => fake()->name(),
            'message' => fake()->text(),
            'level' => 4
        ])->assertUnprocessable();
    }

    public function test_only_the_message_attribute_can_be_updated(): void
    {
        $comment = Comment::factory()->create(['level' => 1]);

        $this->patchJson('api/comments/' . $comment->id, [
            'user' => 'Modified User',
            'message' => 'Updated message',
        ])
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has(
                    'data',
                    fn (AssertableJson $json) =>
                    $json
                        ->where('message', 'Updated message')
                        ->whereNot('user', 'Modified User')
                        ->where('user', $comment->user)
                        ->etc()
                )
            );
    }
}
