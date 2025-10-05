<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_am')->nullable(); // Amharic name
            $table->string('code')->unique();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->string('unit_of_measure'); // pcs, kg, box, etc.
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->integer('reorder_level')->default(10);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
