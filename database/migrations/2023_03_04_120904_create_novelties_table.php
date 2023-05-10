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
        Schema::create('novelties', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_novelty');
            $table->dateTime('date_resolved')->nullable();
            $table->string('description');
            $table->string('type', 20);
            $table->string('details_procces')->nullable();
            $table->string('state', 20);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('classroom_id')->constrained();
            $table->foreignId('computer_id')->nullable()->constrained();
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
        Schema::dropIfExists('novelties');
    }
};
