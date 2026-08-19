<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {
        Schema::table('producer_profiles', function (Blueprint $table) {

            $table->string('company_name')
                ->nullable()
                ->change();


            $table->string('manager_name')
                ->nullable()
                ->change();


            $table->string('province')
                ->nullable()
                ->change();


            $table->string('city')
                ->nullable()
                ->change();

        });
    }



    public function down(): void
    {
        Schema::table('producer_profiles', function (Blueprint $table) {

            $table->string('company_name')
                ->nullable(false)
                ->change();


            $table->string('manager_name')
                ->nullable(false)
                ->change();


            $table->string('province')
                ->nullable(false)
                ->change();


            $table->string('city')
                ->nullable(false)
                ->change();

        });
    }

};
