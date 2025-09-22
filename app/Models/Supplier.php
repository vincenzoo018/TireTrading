<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'contact_person',
        'address',
        'phone',
        'email',
        'payment_terms',
        'status'
    ];
}

// <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('suppliers', function (Blueprint $table) {
//             $table->id();
//             $table->string('company_name');
//             $table->string('contact_person');
//             $table->text('address');
//             $table->string('phone');
//             $table->string('email');
//             $table->string('payment_terms');
//             $table->enum('status', ['active', 'inactive'])->default('active');
//             $table->timestamps();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('suppliers');
//     }
// };
