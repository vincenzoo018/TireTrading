<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id('services_id');
            $table->string('service_name');
            $table->decimal('service_price', 10, 2);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('employee_id');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreign('employee_id')->references('employee_id')->on('employees');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
