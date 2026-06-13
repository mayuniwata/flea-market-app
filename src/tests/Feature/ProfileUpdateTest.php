<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_プロフィール編集画面に初期値が表示される()
    {
        $user = User::factory()->create([
            'name' => '山田太郎',
        ]);

        Profile::create([
            'user_id' => $user->id,
            'postcode' => '123-4567',
            'address' => '東京都渋谷区',
            'building' => 'テストマンション',
            'image' => 'profiles/test.jpg',
        ]);

        $response = $this->actingAs($user)
            ->get('/mypage/profile');

        $response->assertSee('山田太郎');
        $response->assertSee('123-4567');
        $response->assertSee('東京都渋谷区');
        $response->assertSee('テストマンション');
        $response->assertSee('storage/profiles/test.jpg');
    }
}