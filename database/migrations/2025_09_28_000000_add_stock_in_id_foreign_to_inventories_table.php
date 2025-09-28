<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            // Add stock_in_id column if not exists
            if (!Schema::hasColumn('inventories', 'stock_in_id')) {
                $table->unsignedBigInteger('stock_in_id')->nullable();
            }
            // Add foreign key constraint
            $table->foreign('stock_in_id')->references('stock_in_id')->on('stock_ins')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropForeign(['stock_in_id']);
            // Optionally drop the column if you want
            // $table->dropColumn('stock_in_id');
        });
    }
};
