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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('name')->nullable();
            $table->integer('price')->nullable();
            $table->integer('id_category')->nullable();
            $table->integer('id_brand')->nullable();
            $table->unsignedInteger('status')->default('0')->comment('0:new 1:sale');
            $table->integer('sale')->nullable();
            $table->string('company')->nullable();
            $table->string('image')->nullable();
            $table->text('detail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};