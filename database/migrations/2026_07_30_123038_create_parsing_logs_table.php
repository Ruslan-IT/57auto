<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('parsing_logs', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('status'); // success, error, warning
            $table->text('message')->nullable();
            $table->json('data')->nullable(); // сырые данные для отладки
            $table->timestamps();

            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('parsing_logs');
    }
};
