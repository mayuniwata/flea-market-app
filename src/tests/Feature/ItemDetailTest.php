<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Item;
use App\Models\Like;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_商品詳細ページに必要な情報が表示される()
    {
        $user = User::factory()->create([
            'name' => '山田太郎',
        ]);

        $item = Item::factory()->create([
            'name' => '腕時計',
            'brand' => 'Rolex',
            'description' => '高級腕時計',
            'price' => 15000,
            'condition' => '良好',
        ]);

        Like::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        Comment::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'かっこいいです',
        ]);

        $response = $this->get('/item/' . $item->id);

        $response->assertSee('腕時計');
        $response->assertSee('Rolex');
        $response->assertSee('高級腕時計');
        $response->assertSee('15,000');
        $response->assertSee('良好');
        $response->assertSee('山田太郎');
        $response->assertSee('かっこいいです');
    }

    public function test_複数選択されたカテゴリが表示される()
    {
        $item = Item::factory()->create();

        $category1 = Category::create([
            'name' => 'ファッション',
        ]);

        $category2 = Category::create([
            'name' => 'メンズ',
        ]);

        $item->categories()->attach([
            $category1->id,
            $category2->id,
        ]);

        $response = $this->get('/item/' . $item->id);

        $response->assertSee('ファッション');
        $response->assertSee('メンズ');
    }
}