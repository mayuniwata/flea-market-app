<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Like;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_いいねアイコンを押すといいねできる()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create();

        $response = $this->actingAs($user)
            ->post('/item/' . $item->id . '/like');

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response->assertRedirect('/item/' . $item->id);
    }

    public function test_再度いいねアイコンを押すといいね解除できる()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create();

        Like::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $this->actingAs($user)
            ->post('/item/' . $item->id . '/like');

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    public function test_いいね済みアイコンは色が変化する()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create();

        Like::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)
            ->get('/item/' . $item->id);

        $response->assertSee('ハートロゴ_ピンク.png');
    }
}