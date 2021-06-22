<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->string('photo_payment')->nullable();
            $table->date('order_date');
            $table->integer('total_price');
            $table->enum('duration',[1,6,12]);
            $table->date('arrival_date');
            $table->date('departure_date')->nullable();
            $table->enum('status',['Lunas','Belum Terbayar']);
            $table->timestamps();

            $table->foreign('room_id')
                ->references('id')->on('rooms')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('bookings');
    }
}
