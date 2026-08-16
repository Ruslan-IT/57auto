<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('car_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->string('key'); // год_выпуска, пробег, кузов, и т.д.
            $table->text('value')->nullable(); // само значение
            $table->string('display_name')->nullable(); // для красивого отображения
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Индексы для быстрого поиска
            $table->index(['car_id', 'key']);
            $table->index('key');
        });
    }

    public function down()
    {
        Schema::dropIfExists('car_attributes');
    }
};
