<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_ログイン済みユーザーはコメント送信できる()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create();

        $response = $this->actingAs($user)
            ->post('/item/' . $item->id . '/comment', [
                'comment' => 'テストコメント',
            ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'テストコメント',
        ]);

        $response->assertRedirect('/item/' . $item->id);
    }

    public function test_ログイン前ユーザーはコメント送信できない()
    {
        $item = Item::factory()->create();

        $this->post('/item/' . $item->id . '/comment', [
            'comment' => 'テストコメント',
        ]);

        $this->assertDatabaseMissing('comments', [
            'comment' => 'テストコメント',
        ]);
    }

    public function test_コメント未入力の場合バリデーションメッセージが表示される()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create();

        $response = $this->actingAs($user)
            ->from('/item/' . $item->id)
            ->post('/item/' . $item->id . '/comment', [
                'comment' => '',
            ]);

        $response->assertSessionHasErrors([
            'comment',
        ]);
    }

    public function test_コメントが255文字以上の場合バリデーションメッセージが表示される()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create();

        $comment = str_repeat('a', 256);

        $response = $this->actingAs($user)
            ->from('/item/' . $item->id)
            ->post('/item/' . $item->id . '/comment', [
                'comment' => $comment,
            ]);

        $response->assertSessionHasErrors([
            'comment',
        ]);
    }
}