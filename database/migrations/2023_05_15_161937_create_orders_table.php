<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount');
            $table->string('buyer', 255);
            $table->string('receipt_id', 20);
            $table->string('items', 255);
            $table->string('buyer_email', 50);
            $table->string('buyer_ip', 20)->nullable();
            $table->text('note');
            $table->string('city', 20);
            $table->string('phone', 20);
            $table->string('hash_key', 255);
            $table->date('entry_at');
            $table->string('entry_by', 10);
            $table->timestamps();
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
