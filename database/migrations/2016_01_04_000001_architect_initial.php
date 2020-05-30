<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArchitectInitial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iap_sessions', function (Blueprint $t) {
            $t->text('buildername')->nullable()->after('type');
            $t->text('builderdescription')->nullable()->after('buildername');
        });

        Schema::table('iap_blocks', function (Blueprint $t) {
            $t->renameColumn('comment', 'buildername');
            $t->text('builderdescription')->nullable()->after('comment');
        });

        Schema::table('iap_collectionitemsets', function (Blueprint $t) {
            $t->text('buildername')->nullable()->after('name');
            $t->text('builderdescription')->nullable()->after('buildername');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iap_collectionitemsets', function (Blueprint $t) {
            $t->dropColumn('buildername');
            $t->dropColumn('builderdescription');
        });
        
        Schema::table('iap_sessions', function (Blueprint $t) {
            $t->dropColumn('buildername');
            $t->dropColumn('builderdescription');
        });

        Schema::table('iap_blocks', function (Blueprint $t) {
            $t->renameColumn('buildername', 'comment');
            $t->dropColumn('builderdescription');
        });
    }
}
