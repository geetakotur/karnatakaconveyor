<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConveyorModels extends Migration
{
    // Table Name
    protected $tableName = 'conveyor_model';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);                // Model Name
            $table->string('modelno', 255);             // Model Number Eg: MX-5000
            $table->string('image', 255);               // Model Number Eg: image1.png
            $table->text('desc');                       // Description

            $table->string('application');              // useful for application 
            $table->string('width');                    // width
            $table->string('weight');                   // weight
            $table->string('load');                     // load
            $table->string('speed');                    // speed
            $table->string('movement');                 // movement type

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
