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
        Schema::create('child_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent');
            $table->unsignedBigInteger('child');
            $table->timestamps();

            $table->foreign('parent')
                 ->references('original_id')
                 ->on('items')
                 ->onDelete('cascade');

            $table->foreign('child')
                 ->references('original_id')
                 ->on('items')
                 ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('child_items');
    }
};
