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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('type')->default('TÉCNICO');
            $table->string('main_category')->default('TECNOLOGIA E PROFISSÃO');
            $table->integer('duration_hours')->default(1500);
            $table->integer('modules_count')->default(7);
            $table->integer('access_period_months')->default(15);
            $table->string('modality')->default('EAD');

            // Pricing information
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('enrollment_fee', 8, 2)->default(70);
            $table->integer('max_installments')->default(15);
            $table->decimal('installment_value', 8, 2)->default(189.02);

            // Course visibility and highlighting
            $table->boolean('featured')->default(false);
            $table->boolean('active')->default(true);

            // Content fields
            $table->text('target_audience')->nullable();
            $table->text('payment_info')->nullable();
            $table->text('payment_conditions')->nullable();

            // Instructor and level
            $table->string('instructor')->nullable();
            $table->string('level')->default('Técnico');
            $table->string('category')->nullable();
            $table->string('owner');

            // Images
            $table->string('image')->nullable();
            $table->string('banner')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
