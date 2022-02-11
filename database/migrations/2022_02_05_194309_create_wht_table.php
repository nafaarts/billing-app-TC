<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wht', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('client')->onDelete('cascade');
            $table->string('reference_code');
            $table->string('wht_number')->nullable();
            $table->date('wht_date')->nullable();
            $table->integer('percentage');
            $table->string('filename')->nullable();
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
        Schema::dropIfExists('wht');
    }
}
