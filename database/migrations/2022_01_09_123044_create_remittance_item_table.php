<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemittanceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remittance_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('remittance_id')->constrained('remittance')->onDelete('cascade');
            $table->foreignId('invoice_id')->constrained('invoice')->onDelete('cascade');
            $table->bigInteger('pph_tax')->nullable();
            $table->bigInteger('net_amount');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('remittance_item');
    }
}
