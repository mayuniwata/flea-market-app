<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Like;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_商品名で部分一致検索ができる()
    {
        Item::factory()->create([
            'name' => '腕時計',
        ]);

        Item::factory()->create([
            'name' => 'ノートPC',
        ]);

        $response = $this->get('/?keyword=腕');

        $response->assertSee('腕時計');
        $response->assertDontSee('ノートPC');
    }

    public function test_検索状態がマイリストでも保持されている()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create([
            'name' => '腕時計',
        ]);

        Like::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)->get('/?tab=mylist&keyword=腕');

        $response->assertSee('腕時計');
        $response->assertSee('value="腕"', false);
    }
}