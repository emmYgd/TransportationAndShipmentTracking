<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            
            $table->id();
            $table->string('admin_abstraction_id');

           $table->integer('shipmentDay');
           $table->integer('shipmentMonth'); 
           $table->integer('shipmentYear');  

            $table->integer('shipmentHour');
            $table->integer('shipmentMinute');
            $table->integer('shipmentSecond'); 

            $table->integer('deliveryDay');
            $table->integer('deliveryMonth');
            $table->integer('deliveryYear');

            $table->string('shiperFullName'); 
            $table->string('shiperAddress');

            $table->string('receiverFullName');
            $table->string('receiverAddress');
    
            $table->float('price');
            $table->string('status');

            $table->string('commodity');
            $table->string('commodityTypes');
            $table->string('commodityQuantity'); 
            $table->string('commodityContent');

            $table->string('destination');
            $table->string('origin'); 
            $table->string('portOrigin')->nullable(); 

            $table->enum('mode', ['Processing', 'PickUp', 'In-Transit', 'On-hold'])->default('Processing');
            $table->float('weight_kgs');
            $table->float('weight_cubic');
            $table->string('allocation')->nullable(); 

            $table->string('service_type'); 
            $table->string('size_type'); 
            $table->string('add_info')->nullable(); 
            $table->string('shipmentTravelHistory')->nullable(); 

            $table->string('trackingCode');
            $table->string('referenceCode'); 
        
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
        Schema::dropIfExists('user');
    }
}
?>