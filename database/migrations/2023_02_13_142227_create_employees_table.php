<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');

            $table->foreignId('country_id')->constrained('countries');
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('state_id')->constrained('states');

            $table->char('zip_code');
            $table->date('birthdate')->nullable();
            $table->date('date_hired')->nullable();
            $table->string('address');
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
        Schema::dropIfExists('employees');
    }
};
