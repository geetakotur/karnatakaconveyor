<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerUsers extends Migration
{
    // Table Name
    protected $tableName = 'customer_user';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();

            $table->string('first_name', 50);               // Customer First Name  Eg: Jon
            $table->string('last_name', 50);                // Customer Last Name   Eg: Doe

            $table->string('email', 250);                   // Customer E-Mail
            $table->string('mobile', 15);                   // Customer Mobile Number
            $table->string('address', 200);                 // Customer Address
            $table->string('city', 50);                     // Customer City
            $table->string('state', 50);                    // Customer State

            // Auth
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();

            $table->date('registerd_on');                   // Customer Registration Date

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
