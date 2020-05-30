<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFacToSubmissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iap_submissions', function (Blueprint $t) {
            $t->integer('facilitator_id')
                ->after('user_id')
                ->nullable()
                ->unsigned();

            $t->foreign('facilitator_id')
                ->references('id')
                ->on('iap_facilitators')
                ->onUpdate('cascade')
                ->onDelete('restrict');
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
            $t->dropForeign('iap_submissions_facilitator_id_foreign');
            $t->dropColumn('facilitator_id');
        });
    }
}
