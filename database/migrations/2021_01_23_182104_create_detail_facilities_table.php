<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_facilities', function (Blueprint $table) {
            $table->integer('facility_id')->unsigned()->index();
            $table->integer('room_type_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('facility_id')
                ->references('id')->on('facilities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('room_type_id')
                ->references('id')->on('room_types')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_facilities');
    }
}
