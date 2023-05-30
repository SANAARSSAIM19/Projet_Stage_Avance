<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvanceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   

    public function up()
    {
        Schema::create('advance_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->foreignId('type_id')->constrained('types');
            $table->decimal('advance_amount', 8, 2);
            $table->text('comments')->nullable();
            $table->boolean('etat')->nullable()->default(null);;

          

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
        Schema::dropIfExists('advance_requests');
    }
}
