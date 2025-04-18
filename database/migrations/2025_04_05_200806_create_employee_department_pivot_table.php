<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_department', function (Blueprint $table) {
            $table->uuid('employee_id');
            $table->uuid('department_id');
            
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');
                
            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('cascade');
                
            $table->primary(['employee_id', 'department_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_department');
    }
};
