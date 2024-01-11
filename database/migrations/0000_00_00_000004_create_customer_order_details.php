<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrderDetails extends Migration
{
    // Table Name
    protected $tableName = 'customer_order_details';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customer_user')->onDelete('cascade');
            
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')->on('customer_order')->onDelete('cascade');
            
            $table->string('item', 200);                // item
            $table->string('desc', 200);                // item description
            $table->integer('price')->unsigned();       // item price
            $table->integer('qty')->unsigned();         // item quantity

            $table->bigInteger('total')->unsigned();    // item total

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
        Schema::dropIfExists($this->tableName);
    }
}
