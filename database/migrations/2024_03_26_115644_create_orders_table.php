<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
    $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->date('order_date');
            $table->integer('discount_id')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('subtotal');
            $table->unsignedBigInteger('total_amount');
            $table->enum('payment_method',['cod', 'transfer']);
            $table->enum('bank_name',['BCA', 'BRI', 'BSI', 'Mandiri'])->nullable();
            $table->integer('card_number')->nullable();
            $table->enum('payment_status',['paid','not_paid'])->default('not_paid');
            $table->enum('status', ['pending', 'shipped', 'delivered','cancelled'])->default('pending');
            $table->datetime('shipped_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
