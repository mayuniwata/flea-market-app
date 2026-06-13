<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentMethodTest extends TestCase
{
    use RefreshDatabase;

    public function test_支払い方法が小計画面に反映される()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create();

        $response = $this->actingAs($user)
            ->get('/purchase/' . $item->id);

        $response->assertSee('支払い方法');
        $response->assertSee('コンビニ支払い');
        $response->assertSee('カード支払い');
    }
}
