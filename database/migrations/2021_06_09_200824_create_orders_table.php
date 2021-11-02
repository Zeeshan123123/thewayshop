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
            $table->foreignId('user_id')->nullable()->index();
            // $table->foreignId('cart_id')->nullable();
            $table->string('order_number')->nullable(); 
            $table->string('billing_first_name')->nullable();
            $table->string('billing_last_name')->nullable();
            $table->string('billing_email')->nullable();
            // $table->string('billing_address_1')->nullable();
            // $table->string('billing_address_2')->nullable();
            $table->string('billing_post_code')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_country')->nullable();
            // $table->string('order_comments')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_id')->nullable();
            $table->longText('payment_token')->nullable();
            $table->string('coupen_code')->nullable();
            $table->string('coupen_amount')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('is_paid')->default(0);
            $table->enum('status',['pending','processing','success'])->default('pending');
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
