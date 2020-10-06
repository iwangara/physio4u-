<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('address')->nullable();
            $table->string('created_by')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id') // foreign key column name.
            ->references('id') // parent table primary key.
            ->on('users') // parent table name.
            ->onDelete('cascade');
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
        Schema::dropIfExists('patients');
    }
}
