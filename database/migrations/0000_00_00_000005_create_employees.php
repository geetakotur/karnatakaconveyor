<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployees extends Migration
{
    // Table Name
    protected $tableName = 'employees';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('eid', 100)->nullable();                     // Employee Id
            $table->date('joining_date');                               // Employee joining date

            
            $table->string('name', 200)->nullable();                    // Employee Name
            $table->string('email', 200)->nullable();                   // Employee Name
            $table->string('address', 200)->nullable();                 // Employee Address
            
            $table->bigInteger('salary')->unsigned()->default(0);       // Employee Salary

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
