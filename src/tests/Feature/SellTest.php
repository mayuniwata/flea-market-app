<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SellTest extends TestCase
{
    use RefreshDatabase;

    public function test_商品出品情報が保存できる()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $category1 = Category::create([
            'name' => 'ファッション',
        ]);

        $category2 = Category::create([
            'name' => '家電',
        ]);

        $image = UploadedFile::fake()->createWithContent(
    'test.jpg',
    'dummy image content'
);

        $response = $this->actingAs($user)
            ->post('/sell', [
                'image' => $image,
                'categories' => [
                    $category1->id,
                    $category2->id,
                ],
                'condition' => '良好',
                'name' => 'テスト商品',
                'brand' => 'テストブランド',
                'description' => 'テスト説明',
                'price' => 5000,
            ]);

        $this->assertDatabaseHas('items', [
            'name' => 'テスト商品',
            'brand' => 'テストブランド',
            'description' => 'テスト説明',
            'price' => 5000,
            'condition' => '良好',
        ]);

        $item = Item::first();

        $this->assertDatabaseHas('category_item', [
            'item_id' => $item->id,
            'category_id' => $category1->id,
        ]);

        $this->assertDatabaseHas('category_item', [
            'item_id' => $item->id,
            'category_id' => $category2->id,
        ]);

        Storage::disk('public')->assertExists(
            str_replace('storage/', '', $item->image)
        );

        $response->assertRedirect('/');
    }
}