<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWapuToRemittanceItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('remittance_item', function (Blueprint $table) {
            $table->bigInteger('kurs');
            $table->enum('wapu', [0, 1])->default(0);
            $table->enum('wht', [0, 1])->default(0);
            $table->date('ssp_lb_date')->nullable();
            $table->bigInteger('adm_other')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('remittance_item', function (Blueprint $table) {
            $table->dropColumn(['kurs', 'wapu', 'wht', 'adm_other', 'ssp_lb_date']);
        });
    }
}
