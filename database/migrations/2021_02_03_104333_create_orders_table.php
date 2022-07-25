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
            $table->id();
            $table->integer('user_id');
            $table->integer('quantity');
            $table->decimal('sub_total',10,2)->default(0.00);
            $table->decimal('service_fee',10,2)->default(0.00);
            $table->decimal('delivery_fee',10,2)->default(0.00);
            $table->decimal('discount',10,2)->default(0.00);
            $table->decimal('total',10,2)->default(0.00);
            $table->integer('order_status')->comment('1= Pending, 2 = Pickup, 3 = Confirm Arrival, 4 = Delivered');
            $table->string('stripe_token',100)->nullable();
            $table->string('transaction_id',100)->nullable();
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
