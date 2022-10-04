<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saham_prices', function (Blueprint $table) {
            $table->id();
            $table->string('symbol')->unique();
            $table->dateTime('last_date', $precision=0);
            $table->decimal('open', 16, 6);
            $table->decimal('high', 16, 6);
            $table->decimal('low', 16, 6);
            $table->decimal('close', 16, 6);
            $table->decimal('adjClose', 16, 6);
            $table->decimal('volume', 16, 6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saham_prices');
    }
};
