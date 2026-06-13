<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPurchaseDetailsToPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases', function (Blueprint $table) {
        $table->string('payment_method')->nullable();
        $table->string('postcode')->nullable();
        $table->string('address')->nullable();
        $table->string('building')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
        $table->dropColumn([
            'payment_method',
            'postcode',
            'address',
            'building',
        ]);
    });
    }
}
