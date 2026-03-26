<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('image')->nullable();
            $table->string('postal',8)->nullable();
            $table->string('address')->nullable();
            $table->string('building')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users','image')) {
            $table->dropColumn('image');
        }

        if (Schema::hasColumn('users','postal')) {
            $table->dropColumn('postal');
        }

        if (Schema::hasColumn('users','address')) {
            $table->dropColumn('address');
        }

        if (Schema::hasColumn('users','building')) {
            $table->dropColumn('building');
        }
        
        });
    }
}