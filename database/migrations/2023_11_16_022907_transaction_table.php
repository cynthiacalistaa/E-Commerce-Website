<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('usersid');
            $table->string('alamat');
            $table->bigInteger('province_id');
            $table->bigInteger('regency_id');
            $table->bigInteger('district_id');
            $table->bigInteger('village_id');
            $table->integer('kodepos');
            $table->date('transaction_date');
            $table->string('status')->default(0);
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
        Schema::dropIfExists('transaction');
    }
}
