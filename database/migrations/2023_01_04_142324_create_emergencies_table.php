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
        Schema::create('emergencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_Id');
            $table->string('student_Name')->nullable();
            $table->unsignedBigInteger('doctor_Id')->nullable();//for doctor if accepted emergency
            $table->string('doctor_Name')->nullable();
            $table->longText('emergency_description');
            $table->string('latitude');
            $table->string('longitude'); 
            $table->string('status');
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
        Schema::dropIfExists('emergencies');
    }
};
