<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBouncerModifications extends Migration
{
    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abilities', function (Blueprint $t) {
            $t->integer('scope')->after('only_owned')->nullable();
        });

        Schema::table('roles', function (Blueprint $t) {
            $t->integer('scope')->after('level')->nullable();
        });

        Schema::table('assigned_roles', function (Blueprint $t) {
            $t->integer('scope')->after('entity_type')->nullable();
        });

        Schema::table('permissions', function (Blueprint $t) {
            $t->integer('scope')->after('forbidden')->nullable();
        });
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down() {
        Schema::table('permissions', function (Blueprint $t) {
            $t->dropColumn('scope');
        });

        Schema::table('assigned_roles', function (Blueprint $t) {
            $t->dropColumn('scope');
        });

        Schema::table('roles', function (Blueprint $t) {
            $t->dropColumn('scope');
        });

        Schema::table('abilities', function (Blueprint $t) {
            $t->dropColumn('scope');
        });
    }
}
