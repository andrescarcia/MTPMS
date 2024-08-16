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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('case_number');
            $table->dateTime('date');
            $table->string('pais');
            $table->string('CC');
            $table->string('part_number');
            $table->string('description');
            $table->integer('quantity');
            $table->string('provider');
            $table->decimal('unitary_price');
            $table->decimal('total_price');
            $table->string('priority');
            $table->string('OC');
            $table->string('ETA');
            $table->foreignId('client_id')->constrained('clients')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
