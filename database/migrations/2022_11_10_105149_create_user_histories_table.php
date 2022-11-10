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
        Schema::create('user_histories', function (Blueprint $table) {
            $table->id();
            $table->string('by');
            $table->unsignedBigInteger('item_id');
            $table->boolean('vafourites')->default(false);
            $table->boolean('hide')->default(false);
            $table->boolean('submissions')->default(false);
            $table->timestamps();

            $table->foreign('by')
                    ->references('username')
                    ->on('users')
                    ->onDelete('cascade');
            $table->foreign('item_id')
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
        Schema::dropIfExists('user_histories');
    }
};
