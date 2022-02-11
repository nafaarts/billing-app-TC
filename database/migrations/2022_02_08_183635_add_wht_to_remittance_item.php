<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWhtToRemittanceItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('remittance_item', function (Blueprint $table) {
            $table->foreignId('wht_id')->nullable()->after('wht')->constrained('wht')->onDelete('cascade');
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
            $table->dropColumn('wht_id');
        });
    }
}
