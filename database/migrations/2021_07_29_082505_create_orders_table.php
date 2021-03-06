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
            $table->foreignId('meal_id')->constrained('meals');
            $table->integer('qty')->nullable();
            $table->float('total_price')->nullable();
            $table->string('order_number')->nullable();
            $table->string('common_order_number')->nullable();
            $table->string('user_id')->nullable();
            $table->smallInteger('status')->default(1); // 1 => Pending; 2 => Success; 3 => Failure;
            $table->smallInteger('payment_type');
            $table->string('rzp_id')->nullable();
            $table->float('each_price')->nullable();
            $table->foreignId('wallet_detail_id')->nullable()->constrained('wallet_details');
            $table->foreignId('wallet_id')->nullable()->constrained('wallets');
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
