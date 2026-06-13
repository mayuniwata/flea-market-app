<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Like;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MylistTest extends TestCase
{
    use RefreshDatabase;

    public function test_いいねした商品だけが表示される()
    {
        $user = User::factory()->create();

        $likedItem = Item::factory()->create([
            'name' => 'いいねした商品',
        ]);

        $notLikedItem = Item::factory()->create([
            'name' => 'いいねしてない商品',
        ]);

        Like::create([
            'user_id' => $user->id,
            'item_id' => $likedItem->id,
        ]);

        $response = $this->actingAs($user)->get('/?tab=mylist');

        $response->assertSee('いいねした商品');
        $response->assertDontSee('いいねしてない商品');
    }

    public function test_マイリストで購入済み商品はsoldと表示される()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create([
            'name' => '購入済み商品',
        ]);

        Like::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        Purchase::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)->get('/?tab=mylist');

        $response->assertSee('Sold');
    }

    public function test_未認証の場合はマイリストに何も表示されない()
    {
        Item::factory()->create([
            'name' => '商品A',
        ]);

        $response = $this->get('/?tab=mylist');

        $response->assertDontSee('商品A');
    }
}