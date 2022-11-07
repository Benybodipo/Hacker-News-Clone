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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('original_id')->unique();
            $table->string('url')->nullable();
            $table->string('by');
            $table->text('text')->nullable();
            $table->unsignedBigInteger('type')->nullable();
            $table->string('kids')->nullable();
            $table->integer('score')->nullable();
            $table->json('parts')->nullable();
            $table->string('descendants')->nullable();
            $table->boolean('dead')->default(false);
            $table->boolean('deleted')->defaul(false);
            $table->date('time');
            $table->timestamps();
            $table->foreign('type')
                 ->references('id')
                 ->on('types')
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
        Schema::dropIfExists('items');
    }
};
