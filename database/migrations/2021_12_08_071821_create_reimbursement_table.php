<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReimbursementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->string('draft_no')->nullable();
            $table->date('date');
            $table->string('job_reference');
            $table->string('terms');
            $table->json('description');
            $table->foreignId('client_id')->constrained('client')->onDelete('cascade');
            $table->foreignId('bank_id')->constrained('bank_account')->onDelete('cascade');
            $table->string('tax_invoice')->nullable();
            $table->string('ppn')->nullable();
            $table->string('received_by');
            $table->date('received_date');
            $table->enum('invoice_type', ['invoice', 'reimbursment']);
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('invoice');
    }
}
