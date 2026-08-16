<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Проверяем, существует ли таблица car_attributes
        if (!Schema::hasTable('car_attributes')) {
            Schema::create('car_attributes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('car_id')->constrained()->onDelete('cascade');
                $table->string('key');
                $table->text('value')->nullable();
                $table->string('display_name')->nullable();
                $table->integer('sort_order')->default(0);
                $table->timestamps();

                $table->index(['car_id', 'key']);
                $table->index('key');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('car_attributes');
    }
};
