<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HelixInitial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        // Modules
        Schema::create('helix_modules', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 50)->default('');
            $t->string('title', 50)->default('');
            $t->string('description', 255)->default('');
            $t->boolean('enabled')->default(1);
            $t->timestamps();
        });

        // Abilities
        Schema::create('abilities', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 150)->default('');
            $t->string('title')->nullable();
            $t->boolean('restricted')->default(0);
            $t->integer('entity_id')->unsigned()->nullable();
            $t->string('entity_type', 150)->nullable();
            $t->boolean('only_owned')->default(false);
            $t->timestamps();

            $t->unique(
                ['name', 'entity_id', 'entity_type', 'only_owned'],
                'abilities_unique_index'
            );

            // Foreign Keys
            $t->integer('module_id')->unsigned()->default(0);

            // References
            $t->foreign('module_id')->references('id')->on('helix_modules')
                ->onUpdate('cascade');
        });

        // Roles
        Schema::create('roles', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 100)->unique()->default('');
            $t->string('title', 100)->nullable();
            $t->integer('level')->unsigned()->nullable();
            $t->boolean('hidden')->default(0);
            $t->timestamps();
        });

        // Assigned Roles
        Schema::create('assigned_roles', function (Blueprint $t) {
            $t->integer('role_id')->unsigned()->index()->default(0);
            $t->morphs('entity', 'assigned_roles_entity_id_entity_type_index');

            $t->foreign('role_id')->references('id')->on('roles')
                  ->onUpdate('cascade')->onDelete('cascade');
        });

        // Permissions
        Schema::create('permissions', function (Blueprint $t) {
            $t->integer('ability_id')->unsigned()->index()->default(0);
            $t->morphs('entity', 'permissions_entity_id_entity_type_index');
            $t->boolean('forbidden')->default(false);

            $t->foreign('ability_id')->references('id')->on('abilities')
                  ->onUpdate('cascade')->onDelete('cascade');
        });

        // People
        Schema::create('helix_people', function (Blueprint $t) {
            $t->increments('id');
            $t->string('firstname', 50)->default('');
            $t->string('lastname', 50)->nullable();
            $t->string('address', 150)->nullable();
            $t->char('postalcode', 10)->nullable();
            $t->string('city', 50)->nullable();
            $t->string('email', 50)->nullable();
            $t->string('phone', 50)->nullable();
            $t->string('phone_ext', 50)->nullable();
            $t->string('mobile', 50)->nullable();
            $t->string('mobile_ext', 50)->nullable();
            $t->timestamps();
            $t->softDeletes();
        });

        // Employees
        Schema::create('helix_employees', function (Blueprint $t) {
            $t->increments('id');
            $t->string('nextofkin_name', 100)->nullable();
            $t->string('nextofkin_phone', 50)->nullable();
            $t->string('nextofkin_phone_ext', 10)->nullable();
            $t->string('nextofkin_mobile', 50)->nullable();
            $t->string('nextofkin_mobile_ext', 10)->nullable();
            $t->timestamps();
            $t->softDeletes();

            // Foreign Keys
            $t->integer('person_id')->unsigned()->nullable()->default(0);

            // References
            $t->foreign('person_id')->references('id')->on('helix_people')
                    ->onUpdate('cascade');
        });

        // Users
        Schema::table('users', function (Blueprint $t) {
            $t->boolean('hidden')->default(0);
            $t->string('api_token', 100)->unique()->default('');
            $t->json('settings')->nullable();

            // Foreign Keys
            $t->integer('person_id')->unsigned()->nullable();

            // References
            $t->foreign('person_id')->references('id')->on('helix_people')
                ->onUpdate('cascade');

            // Remove the name column
            $t->dropColumn('name');
        });

        // Menuitems
        Schema::create('helix_menuitems', function (Blueprint $t) {
            $t->increments('id');
            $t->string('title', 100)->default('');
            $t->string('route', 100)->nullable();
            $t->string('icon', 50)->nullable();
            $t->string('role', 50)->nullable();
            $t->string('ability', 50)->nullable();
            $t->string('active', 100)->nullable();
            $t->integer('sorting')->nullable();
            $t->boolean('is_header')->default(0);
            $t->string('description', 50)->nullable();

            // Indeces
            $t->unique('description');

            // Foreign Keys
            $t->integer('module_id')->unsigned()->default(0);
            $t->integer('menuitem_id')->unsigned()->nullable();

            // References
            $t->foreign('module_id')->references('id')->on('helix_modules')
                ->onUpdate('cascade');
            $t->foreign('menuitem_id')->references('id')->on('helix_menuitems')
                ->onUpdate('cascade');
        });

        // Devices
        Schema::create('helix_devices', function (Blueprint $t) {
            $t->increments('id');
            $t->string('serial', 128)->default('');
            $t->string('os_version', 64)->default('');
            $t->integer('build')->default(0);
            $t->string('app_version', 64)->default('');
            $t->string('bundle_id', 512)->default('');
            $t->string('model', 64)->default('');
            $t->boolean('jailbroken')->nullable();
            $t->json('other')->nullable();
            $t->timestamps();

            // Foreign Keys
            $t->integer('module_id')->unsigned()->nullable();

            // References
            $t->foreign('module_id')->references('id')->on('helix_modules')
                ->onUpdate('cascade');
        });

        // Device - User pivot
        Schema::create('helix_device_users', function (Blueprint $t) {
            $t->increments('id');
            $t->timestamps();

            $t->integer('device_id')->unsigned()->default(0);
            $t->integer('user_id')->unsigned()->default(0);

            $t->foreign('device_id')
                ->references('id')
                ->on('helix_devices')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $t->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::drop('helix_device_users');
        Schema::drop('helix_devices');
        Schema::drop('helix_menuitems');
        Schema::drop('helix_employees');
        Schema::drop('helix_people');
        Schema::drop('permissions');
        Schema::drop('assigned_roles');
        Schema::drop('roles');
        Schema::drop('abilities');
        Schema::drop('helix_modules');

        Schema::enableForeignKeyConstraints();
    }
}
