<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('stock');
            $table->enum('type', ['producto_terminado', 'materia_prima']);
            $table->string('sku');
            $table->string('barcode');
            $table->string('size');
            $table->string('color');
            $table->string('material');
            $table->string('location');
            $table->decimal('price', 12, 2);
            
            $table->date('date_manufactured');
            $table->text('notes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
