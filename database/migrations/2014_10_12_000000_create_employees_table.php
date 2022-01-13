<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('avatar')->nullable();
            $table->enum('gender', ['male', 'female','other'])->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('status')->default(0)->index();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
