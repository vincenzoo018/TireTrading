<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id('delivery_id');
            $table->date('delivery_date');
            $table->string('receiving_no');
            $table->decimal('shipping_fee', 8, 2);
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('order_id');
            $table->foreign('customer_id')->references('customer_id')->on('customers');
            $table->foreign('order_id')->references('order_id')->on('orders');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
