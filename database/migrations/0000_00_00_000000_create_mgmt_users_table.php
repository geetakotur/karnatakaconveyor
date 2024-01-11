<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMgmtUsersTable extends Migration
{
    // Table Name
    protected $tableName = 'mgmt_user';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();

            // Auth
            $table->boolean('isMgmt')->default(true);
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();

            // $table->timestamp('email_verified_at')->nullable();
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
