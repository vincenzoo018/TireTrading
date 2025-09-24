<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('receivings', function (Blueprint $table) {
            $table->id('receiving_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('receiving_no')->unique();
            $table->string('reference_number')->nullable();
            $table->date('receive_date');
            $table->date('delivery_date')->nullable();
            $table->decimal('sub_total', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('shipping_fee', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers');
            $table->foreign('employee_id')->references('employee_id')->on('employees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receivings');
    }
};
