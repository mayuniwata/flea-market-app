<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Profile;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MypageTest extends TestCase
{
    use RefreshDatabase;

    public function test_プロフィール画像ユーザー名出品商品購入商品が表示される()
    {
        $user = User::factory()->create([
            'name' => '山田太郎',
        ]);

        Profile::create([
            'user_id' => $user->id,
            'image' => 'profiles/test.jpg',
        ]);

        Item::factory()->create([
            'user_id' => $user->id,
            'name' => '出品商品',
        ]);

        $purchasedItem = Item::factory()->create([
            'name' => '購入商品',
        ]);

        Purchase::create([
            'user_id' => $user->id,
            'item_id' => $purchasedItem->id,
        ]);

        $sellResponse = $this->actingAs($user)
            ->get('/mypage?page=sell');

        $sellResponse->assertSee('山田太郎');
        $sellResponse->assertSee('storage/profiles/test.jpg');
        $sellResponse->assertSee('出品商品');

        $buyResponse = $this->actingAs($user)
            ->get('/mypage?page=buy');

        $buyResponse->assertSee('購入商品');
    }
}