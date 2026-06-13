<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;

class PurchaseSeeder extends Seeder
{
    public function run()
    {
        Purchase::create([
            'user_id' => 1,
            'item_id' => 3,
        ]);
    }
}
