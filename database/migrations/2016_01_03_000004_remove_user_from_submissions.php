<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUserFromSubmissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iap_submissions', function (Blueprint $t) {
            $t->dropForeign('iap_submissions_user_id_foreign');
            $t->dropColumn('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iap_submissions', function (Blueprint $t) {
            $t->integer('user_id')
                ->after('updated_at')
                ->nullable()
                ->unsigned();

            $t->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade');
        });
    }
}
