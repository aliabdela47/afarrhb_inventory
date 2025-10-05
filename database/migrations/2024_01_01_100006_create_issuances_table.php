<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('issuances', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique(); // Model-19 or Model-22 number
            $table->enum('type', ['model_19', 'model_22']); // Model-19 or Model-22
            $table->foreignId('warehouse_id')->constrained()->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('emp_list')->cascadeOnDelete();
            $table->foreignId('issued_by')->constrained('users')->cascadeOnDelete();
            $table->date('issue_date');
            $table->date('issue_date_ethiopian')->nullable(); // Ethiopian calendar
            $table->enum('status', ['pending', 'approved', 'issued', 'returned', 'cancelled'])->default('pending');
            $table->text('purpose')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('issuances');
    }
};
