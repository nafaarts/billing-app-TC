<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemittanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remittance', function (Blueprint $table) {
            $table->id();
            $table->string('remittance_no');
            $table->date('date');
            $table->foreignId('bank_id')->constrained('bank_account')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('client')->onDelete('cascade');
            $table->enum('currency', ['Dollar', 'Rupiah'])->default('Rupiah');
            $table->string('gap_type')->nullable();
            $table->string('gap_value')->nullable();
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
        Schema::dropIfExists('remittance');
    }
}
