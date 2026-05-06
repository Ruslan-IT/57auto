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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('model_id')->constrained();

            $table->string('lot')->unique();                // номер лота
            $table->string('title')->nullable();            // если нужно генерируемое название
            $table->year('year');
            $table->unsignedTinyInteger('month')->nullable(); // 1..12

            $table->unsignedInteger('mileage')->nullable();   // пробег в км

            $table->string('body_type');                     // кузов (внедорожник, седан...)
            $table->string('engine_type');                   // топливо (электромобиль, бензин...)
            $table->unsignedSmallInteger('engine_power')->nullable();  // кВт
            $table->unsignedSmallInteger('engine_power_30min')->nullable();
            $table->unsignedSmallInteger('engine_volume')->nullable();  // см³

            $table->string('color')->nullable();
            $table->string('transmission');                  // автоматическая, механическая...
            $table->string('drive');                         // передний, задний, полный...

            $table->unsignedInteger('price_china')->nullable();    // цена в Китае (¥)
            $table->unsignedInteger('price_russia')->nullable();   // цена в России (₽)

            $table->boolean('is_min_util')->default(false);
            $table->boolean('is_passable')->default(false);

            $table->string('source_url')->nullable();
            $table->string('source_site')->nullable();       // например, che168.com

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
