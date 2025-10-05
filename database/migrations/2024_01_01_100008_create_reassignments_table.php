<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reassignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('issuance_id')->constrained()->cascadeOnDelete();
            $table->foreignId('from_employee_id')->constrained('emp_list')->cascadeOnDelete();
            $table->foreignId('to_employee_id')->constrained('emp_list')->cascadeOnDelete();
            $table->foreignId('reassigned_by')->constrained('users')->cascadeOnDelete();
            $table->date('reassignment_date');
            $table->text('reason')->nullable();
            $table->enum('status', ['pending', 'approved', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reassignments');
    }
};
