<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //type de produit
            $table->string('position')->nullable();
            $table->string('icon')->default('mdi-brightness-1');
            $table->boolean('sub-category');
            $table->date('date'); //date de création ou de suppression
            $table->string('user_id')->constrained(); //créateur de la ligne de donnée
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
        Schema::dropIfExists('categories');
    }
}
