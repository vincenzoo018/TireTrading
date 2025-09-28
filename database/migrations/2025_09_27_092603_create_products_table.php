<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');

            // foreign key to categories table
            $table->unsignedBigInteger('category_id');

            $table->string('product_name');
            $table->string('brand')->nullable();
            $table->string('size')->nullable();        // e.g., 205/55R16
            $table->string('length')->nullable();
            $table->string('width')->nullable();

            $table->text('description')->nullable();

            // price fields
            $table->decimal('supplier_price', 10, 2)->default(0.00);
            $table->decimal('selling_price', 10, 2)->default(0.00);

            // added stock quantity
            // $table->integer('stock_quantity')->default(0);

            $table->enum('status', ['active', 'inactive'])->default('active');


            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // foreign key constraint
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
