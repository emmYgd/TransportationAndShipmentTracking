<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
      Schema::create('admin', function (Blueprint $table) {
            
        $table->id();
        $table->string('user_abstraction_id');
        $table->string('user_entity_abstration_id');

        $table->string('role');

        $table->enum('admin_name', [env('ADMIN_USERNAME')])->unique();
        $table->enum('password', [env('ADMIN_PASSWORD')])->unique();
        //$table->enum('secret_token', [env('BEARER_TOKEN')])->unique();

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
        Schema::dropIfExists('admin');
    }
}