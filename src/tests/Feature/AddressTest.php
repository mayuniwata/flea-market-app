<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    public function test_変更した住所が購入画面に反映される()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create();

        $this->actingAs($user)
            ->post('/purchase/address/' . $item->id, [
                'postcode' => '123-4567',
                'address' => '東京都渋谷区',
                'building' => 'テストマンション',
            ]);

        $response = $this->actingAs($user)
            ->get('/purchase/' . $item->id);

        $response->assertSee('123-4567');
        $response->assertSee('東京都渋谷区');
        $response->assertSee('テストマンション');
    }

    public function test_購入商品に送付先住所が紐づく()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create();

        $this->actingAs($user)
            ->post('/purchase/' . $item->id, [
                'postcode' => '123-4567',
                'address' => '東京都渋谷区',
                'building' => 'テストマンション',
                'payment_method' => 'カード支払い',
            ]);

        $this->assertDatabaseHas('purchases', [
            'item_id' => $item->id,
            'postcode' => '123-4567',
            'address' => '東京都渋谷区',
            'building' => 'テストマンション',
        ]);
    }
}