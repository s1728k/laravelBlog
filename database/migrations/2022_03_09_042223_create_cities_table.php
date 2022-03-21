<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('state_id');
            $table->string('state_code')->nullable();
            $table->string('state_name')->nullable();
            $table->foreignId('country_id');
            $table->string('country_code')->nullable();
            $table->string('country_name')->nullable();
            $table->double('latitude',10,2)->nullable();
            $table->double('longitude',10,2)->nullable();
            $table->string('wikiDataId')->nullable();
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
        Schema::dropIfExists('cities');
    }
}
