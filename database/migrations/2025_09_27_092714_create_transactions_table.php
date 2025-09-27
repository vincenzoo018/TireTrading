<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->string('reference_num');
            $table->string('product_name');
            $table->string('qty');
            $table->date('delivery_date');
            $table->decimal('delivery_fee', 8, 2);
            $table->boolean('delivery_received')->default(false);
            $table->decimal('tax', 8, 2);
            $table->decimal('sub_total', 10, 2);
            $table->decimal('overall_total', 10, 2);
            $table->unsignedBigInteger('supplier_id');

            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};