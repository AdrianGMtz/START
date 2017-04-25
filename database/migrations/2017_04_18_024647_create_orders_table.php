<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function ($tbl) {
            $tbl->increments('id');
            $tbl->integer('user_id');
            $tbl->integer('client_id');
            $tbl->integer('commission_id');
            $tbl->text('order_comments')->nullable();
            $tbl->boolean('paid')->default(false);
            $tbl->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
