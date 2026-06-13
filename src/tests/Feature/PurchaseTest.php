<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_商品を購入できる()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create();

        $response = $this->actingAs($user)
            ->post('/purchase/' . $item->id, [
                'payment_method' => 'カード支払い',
            ]);

        $this->assertDatabaseHas('purchases', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    public function test_購入商品はsold表示される()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create([
            'name' => '腕時計',
        ]);

        Purchase::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->get('/');

        $response->assertSee('Sold');
    }

    public function test_購入商品がプロフィール購入一覧に表示される()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create([
            'name' => '腕時計',
        ]);

        Purchase::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)
            ->get('/mypage?page=buy');

        $response->assertSee('腕時計');
    }
}