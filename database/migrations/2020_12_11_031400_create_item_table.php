<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTable extends Migration
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
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('url')->nullable();
            $table->boolean('claimed')->default(0);
            $table->text('priority')->default(1);
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('claimant_id')->nullable();
            $table->text('image_url')->nullable()->default(null);
            $table->foreign('claimant_id')->references('id')->on('users');
            $table->foreign('owner_id')->references('id')->on('users');
            //$table->foreign('item_collections_id')->references('id')->on('item_collections');
            $table->softDeletes();
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
        Schema::dropIfExists('items');
    }
}

