<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserEntityModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('user_entity', function (Blueprint $table) {
            
           $table->id();
           $table->string('admin_abstraction_id');

           $table->integer('quoteQueryCount');
           $table->string('quote_user_fullName')->unique();
           $table->string('quote_org_company_name');

           $table->string('quote_contact_phone');
           $table->string('quote_email')->unique();
           $table->string('quote_commodity')

           $table->string('quote_place_of_origin');
           $table->string('quote_port_of_origin');
           $table->string('quote_destination')->nullable();

           $table->string('quote_mode');
           $table->float('quote_weight_kgs');
           $table->float('quote_weight_cubic');

           $table->string('allocation')->nullable();
           $table->string('size_type');

           $table->string('specify_to_get_quote')->nullable();
           $table->float('request_price')->nullable();

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
        Schema::dropIfExists('user_entity');
    }
}

?>
