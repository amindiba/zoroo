<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('buyer_profiles', function (Blueprint $table) {


            $table->id();




            $table->foreignId('user_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();





            $table->string('company_name')
                ->nullable();




            $table->string('phone')
                ->nullable();




            $table->text('requirements')
                ->nullable();





            $table->string('province')
                ->nullable();




            $table->string('city')
                ->nullable();





            $table->string('status')
                ->default('pending');





            $table->index('status');

            $table->index('province');

            $table->index('city');





            $table->timestamps();


        });

    }





    public function down(): void
    {

        Schema::dropIfExists('buyer_profiles');

    }

};
