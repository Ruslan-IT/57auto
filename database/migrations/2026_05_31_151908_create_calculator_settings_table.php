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

        Schema::create('calculator_settings', function (Blueprint $table) {

            $table->id();

            $table->string('country'); // korea / china / etc

            $table->string('currency')->nullable(); // KRW, CNY
            $table->decimal('currency_rate', 12, 6)->default(0);

            // % расходы в стране
            $table->decimal('country_expense_percent', 8, 2)->default(0);

            // банк %
            $table->decimal('bank_percent', 8, 2)->default(0);

            // фикс расходы
            $table->integer('delivery_price')->default(0);
            $table->integer('company_fee')->default(0);
            $table->integer('russia_expenses')->default(0);
            $table->integer('util_fee')->default(0);

            // таможня
            $table->decimal('customs_percent', 8, 2)->default(0);
            $table->integer('customs_fee')->default(0);

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculator_settings');
    }
};
