<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::connection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        
        Schema::table('users', function (Blueprint $table) {
            $table->enum('gender', ['Male', 'Female']);
            $table->date('date_of_birth')->nullable()->change();
            $table->string('avatar')->nullable()->change();
            $table->string('mobile_number')->nullable()->change();
            $table->string('national_id')->unique()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
