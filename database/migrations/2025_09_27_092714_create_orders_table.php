<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('tax', 8, 2);
            $table->decimal('discount', 8, 2)->default(0);
            $table->decimal('overall_total', 10, 2);
            $table->string('payment_method');
            $table->date('order_date');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customers');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
