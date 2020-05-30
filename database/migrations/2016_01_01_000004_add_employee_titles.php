<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmployeeTitles extends Migration
{
    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helix_employee_titles', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name');
            $t->string('title');
        });

        Schema::table('helix_employees', function (Blueprint $t) {
            // Foreign Keys
            $t->integer('employee_title_id')->unsigned()->nullable()->after('nextofkin_mobile_ext');

            // References
            $t->foreign('employee_title_id')
                ->references('id')
                ->on('helix_employees')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down() {
        Schema::table('helix_employees', function (Blueprint $t) {
            $t->dropForeign(['employee_title_id']);
            $t->dropColumn('employee_title_id');
        });

        Schema::dropIfExists('helix_employee_titles');
    }
}
