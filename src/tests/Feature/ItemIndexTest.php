<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_全商品を取得できる()
    {
        Item::factory()->create([
            'name' => '腕時計',
        ]);

        Item::factory()->create([
            'name' => 'HDD',
        ]);

        $response = $this->get('/');

        $response->assertSee('腕時計');
        $response->assertSee('HDD');
    }

    public function test_購入済み商品はsoldと表示される()
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
    public function test_自分が出品した商品は表示されない()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Item::factory()->create([
            'user_id' => $user->id,
            'name' => '自分の商品',
        ]);

        Item::factory()->create([
            'name' => '他人の商品',
        ]);

        $response = $this->get('/');

        $response->assertDontSee('自分の商品');
        $response->assertSee('他人の商品');
    }
}