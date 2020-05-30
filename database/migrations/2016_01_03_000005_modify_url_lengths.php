<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUrlLengths extends Migration
{
    public function up()
    {
        // Because modifying a column in a table that also has a column of type
        // enum is not currently supported (using the Schema builder), we will
        // instead use the DB facade
        DB::statement(
            'ALTER TABLE iap_subsessions MODIFY signature VARCHAR(128)'
        );

        Schema::table('iap_candidate_subsessions', function (Blueprint $t) {
            $t->string('signature', 128)->change();
        });

        Schema::table('iap_charts', function (Blueprint $t) {
            $t->string('url', 128)->change();
        });
    }

    public function down()
    {
        Schema::table('iap_charts', function (Blueprint $t) {
            $t->string('url', 100)->change();
        });

        Schema::table('iap_candidate_subsessions', function (Blueprint $t) {
            $t->string('signature', 50)->change();
        });

        DB::statement(
            'ALTER TABLE iap_subsessions MODIFY signature VARCHAR(50)'
        );
    }
}