<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrders extends Migration
{
    // Table Name
    protected $tableName = 'customer_order';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();

            $table->dateTime('order_date');                         // Customer Purchased Date
            $table->string('invoiceId', 100)->nullable();       // Purchase Bill No Eg: INVOICE-500
            $table->string('payment', 50)->nullable();          // Purchase Payment Mode Eg: Cash / UPI / NEFT / Cheque
            
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customer_user')->onDelete('cascade');
            
            $table->bigInteger('model_id')->unsigned()->nullable();
            $table->foreign('model_id')->references('id')->on('conveyor_model')->onDelete('cascade');
            
            $table->boolean('isQuote')->default(true);              // is quote or invoice
            $table->text('message', 500)->nullable();               // text message
            $table->boolean('approved')->default(false);            // approved by mgmt
            $table->integer('status')->unsigned()->default(0);      // status
            $table->bigInteger('total')->unsigned()->default(0);    // grand total

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
