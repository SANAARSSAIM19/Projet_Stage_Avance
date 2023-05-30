<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemboursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remboursements', function (Blueprint $table) {
            $table->id('id');
            $table->date('premiere_echance');
            $table->date('derniere_echance');
            $table->float('retenue');
            $table->float('solde_fin');
            $table->foreignId('id_demande')->constrained('advance_requests')->onDelete('cascade');
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
        Schema::dropIfExists('remboursements');
    }
}
