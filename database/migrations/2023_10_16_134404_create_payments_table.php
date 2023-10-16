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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('status')->nullable();
            $table->string('intent_id')->nullable();
            $table->unsignedBigInteger('boat_id')->index();
            $table->unsignedDecimal('price', $precision = 11, $scale = 2)->nullable();
            $table->string('currency');
            $table->timestamps();

            $table->foreign('boat_id')->references('id')->on('boats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
