<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_details', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('ram');
            $table->string('hardisk');
            $table->string('location');
            //ideally we should store price as decimal and unit seperately
            $table->string('price'); 
            $table->bigInteger('ram_capacity_mb')->nullable();
            $table->bigInteger('hardisk_capacity_mb')->nullable();
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
        Schema::dropIfExists('server_details');
    }
}
