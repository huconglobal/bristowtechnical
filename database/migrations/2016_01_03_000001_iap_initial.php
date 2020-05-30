<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IapInitial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // iap_blocks
        Schema::create('iap_blocks', function (Blueprint $t) {
            $t->increments('id');
            $t->text('category')->nullable();
            $t->text('objectives')->nullable();
            $t->text('comment')->nullable();
            $t->timestamps();
        });

        // iap_candidateroles
        Schema::create('iap_candidateroles', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 50)->default('');
            $t->string('shorthand', 10)->default('');
            $t->timestamps();
        });

        // iap_charts
        Schema::create('iap_charts', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 50)->default('');
            $t->string('revision', 50)->nullable();
            $t->string('url', 100)->nullable();
            $t->string('type', 20)->nullable();
            $t->timestamps();
        });

        // iap_checktypes
        Schema::create('iap_checktypes', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 100)->default('');
            $t->string('shorthand', 50)->default('');
            $t->timestamps();
        });

        // iap_collectiontypes
        Schema::create('iap_collectiontypes', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 100)->nullable();
            $t->string('shorthand', 100)->nullable();
            $t->timestamps();
        });

        // iap_error_codes
        Schema::create('iap_error_codes', function (Blueprint $t) {
            $t->increments('id');
            $t->string('title', 255)->nullable();
            $t->text('message')->nullable();
            $t->timestamps();
        });

        // iap_eventtypes
        Schema::create('iap_eventtypes', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 50)->default('');
            $t->string('shorthand', 20)->default('');
            $t->timestamps();
        });

        // iap_helicoptertypes
        Schema::create('iap_helicoptertypes', function (Blueprint $t) {
            $t->increments('id');
            $t->string('manufacturer', 50)->default('');
            $t->string('shorthand', 50)->default('');
            $t->string('model', 50)->default('');
            $t->timestamps();
        });

        // iap_levels
        Schema::create('iap_levels', function (Blueprint $t) {
            $t->increments('id');
            $t->text('description')->nullable();
            $t->char('level', 2)->default('');
            $t->timestamps();
        });

        // iap_sessions
        Schema::create('iap_sessions', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 50)->default('');
            $t->string('type', 20)->default('');
            $t->timestamps();
        });

        // iap_simulators
        Schema::create('iap_simulators', function (Blueprint $t) {
            $t->increments('id');
            $t->string('simnr', 50)->default('');
            $t->string('location', 50)->default('');
            $t->timestamps();
        });

        // iap_versions
        Schema::create('iap_versions', function (Blueprint $t) {
            $t->increments('id');
            $t->string('number', 128)->default('');
            $t->tinyInteger('assets')->nullable();
            $t->tinyInteger('contents')->nullable();
            $t->tinyInteger('published')->nullable();
            $t->timestamps();
        });

        // iap_candidates
        Schema::create('iap_candidates', function (Blueprint $t) {
            $t->increments('id');
            $t->char('initials', 5)->default('');
            $t->timestamps();
            $t->softDeletes();

            $t->integer('person_id')->unsigned()->nullable();

            $t->foreign('person_id')
                ->references('id')
                ->on('helix_people')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_documents
        Schema::create('iap_documents', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 100)->default('');
            $t->string('shorthand', 20)->nullable();
            $t->timestamps();

            $t->integer('helicoptertype_id')->unsigned()->nullable();

            $t->foreign('helicoptertype_id')
                ->references('id')
                ->on('iap_helicoptertypes')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_docrevisions
        Schema::create('iap_docrevisions', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('revision')->nullable();
            $t->string('url', 128)->nullable();
            $t->timestamps();

            $t->integer('document_id')->unsigned()->nullable();

            $t->foreign('document_id')
                ->references('id')
                ->on('iap_documents')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // iap_checklists
        Schema::create('iap_checklists', function (Blueprint $t) {
            $t->increments('id');
            $t->string('chapter', 10)->nullable();
            $t->string('name', 100)->default('');
            $t->text('description')->nullable();
            $t->text('indications')->nullable();
            $t->text('confirm')->nullable();
            $t->text('footer')->nullable();
            $t->string('event_name', 50)->nullable();
            $t->boolean('revised')->default(0);
            $t->timestamps();

            $t->integer('docrevision_id')->unsigned()->nullable();
            $t->integer('eventtype_id')->unsigned()->nullable();
            $t->integer('checklist_id')->unsigned()->nullable();

            $t->foreign('docrevision_id')
                ->references('id')
                ->on('iap_docrevisions')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('eventtype_id')
                ->references('id')
                ->on('iap_eventtypes')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('checklist_id')
                ->references('id')
                ->on('iap_checklists')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });

        // iap_events
        Schema::create('iap_events', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 50)->default('');
            $t->text('description')->nullable();
            $t->timestamps();

            $t->integer('eventtype_id')->unsigned()->default(0);

            $t->foreign('eventtype_id')
                ->references('id')
                ->on('iap_eventtypes')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_facilitators
        Schema::create('iap_facilitators', function (Blueprint $t) {
            $t->increments('id');
            $t->string('initials', 10)->nullable();
            $t->timestamps();
            $t->softDeletes();

            $t->integer('person_id')->unsigned()->nullable();

            $t->foreign('person_id')
                ->references('id')
                ->on('helix_people')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_submissions
        Schema::create('iap_submissions', function (Blueprint $t) {
            $t->increments('id');
            $t->timestamps();
            $t->integer('user_id')->unsigned()->nullable();

            $t->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_collections
        Schema::create('iap_collections', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 100)->default('');
            $t->smallInteger('startyear')->default(0);
            $t->tinyInteger('visible')->default(1);
            $t->tinyInteger('is_draft')->default(1);
            $t->text('brief')->nullable();
            $t->boolean('published')->unsigned()->default(0);
            $t->timestamps();

            $t->integer('collectiontype_id')->unsigned()->default(0);
            $t->integer('helicoptertype_id')->unsigned()->default(0);

            $t->foreign('collectiontype_id')
                ->references('id')
                ->on('iap_collectiontypes')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('helicoptertype_id')
                ->references('id')
                ->on('iap_helicoptertypes')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_collectionitemsets
        Schema::create('iap_collectionitemsets', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 128)->nullable();
            $t->timestamps();
        });

        // iap_collectionitems
        Schema::create('iap_collectionitems', function (Blueprint $t) {
            $t->increments('id');
            $t->timestamps();

            $t->integer('checklist_id')->unsigned()->default(0);
            $t->integer('collectionitemset_id')->unsigned()->default(0);

            $t->foreign('checklist_id')
                ->references('id')
                ->on('iap_checklists')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('collectionitemset_id')
                ->references('id')
                ->on('iap_collectionitemsets')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_collection_collectionitemsets
        Schema::create('iap_collection_collectionitemsets', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('sorting')->default(0);
            $t->timestamps();

            $t->integer('collection_id')->unsigned()->default(0);
            $t->integer('collectionitemset_id')->unsigned()->default(0);

            $t->foreign('collection_id')
                ->references('id')
                ->on('iap_collections')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $t->foreign('collectionitemset_id')
                ->references('id')
                ->on('iap_collectionitemsets')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_opcbriefs
        Schema::create('iap_opcbriefs', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('open_book_result')->nullable();
            $t->integer('closed_book_result')->nullable();
            $t->timestamp('briefed_at')->nullable();
            $t->timestamps();

            $t->integer('candidate_id')->unsigned()->nullable();
            $t->integer('collection_id')->unsigned()->nullable();

            $t->foreign('candidate_id')
                ->references('id')
                ->on('iap_candidates')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('collection_id')
                ->references('id')
                ->on('iap_collections')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_checkitems
        Schema::create('iap_checkitems', function (Blueprint $t) {
            $t->increments('id');
            $t->text('description')->nullable();
            $t->text('option')->nullable();
            $t->integer('sorting_order')->default(0);
            $t->integer('display_order')->nullable();
            $t->tinyInteger('silent')->nullable();
            $t->tinyInteger('shuttle')->nullable();
            $t->timestamps();

            $t->integer('checklist_id')->unsigned()->default(0);
            $t->integer('checktype_id')->unsigned()->default(0);

            $t->foreign('checklist_id')
                ->references('id')
                ->on('iap_checklists')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $t->foreign('checktype_id')
                ->references('id')
                ->on('iap_checktypes')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_block_events
        Schema::create('iap_block_events', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('sorting')->default(0);
            $t->text('description')->nullable();
            $t->text('solo_description')->nullable();
            $t->timestamps();

            $t->integer('block_id')->unsigned()->default(0);
            $t->integer('event_id')->unsigned()->default(0);

            $t->foreign('block_id')
                ->references('id')
                ->on('iap_blocks')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('event_id')
                ->references('id')
                ->on('iap_events')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_checklist_events
        Schema::create('iap_checklist_events', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('sorting')->default(0);
            $t->timestamps();

            $t->integer('checklist_id')->unsigned()->default(0);
            $t->integer('event_id')->unsigned()->default(0);

            $t->foreign('checklist_id')
                ->references('id')
                ->on('iap_checklists')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('event_id')
                ->references('id')
                ->on('iap_events')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_sessionitemsets
        Schema::create('iap_sessionitemsets', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 128)->nullable();
            $t->timestamps();
        });

        // iap_sessionitems
        Schema::create('iap_sessionitems', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('sorting')->nullable();
            $t->string('description', 255)->nullable();
            $t->text('remark')->nullable();
            $t->timestamps();

            $t->integer('sessionitemset_id')->unsigned()->default(0);

            $t->foreign('sessionitemset_id')
                ->references('id')
                ->on('iap_sessionitemsets')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // iap_collection_sessions
        Schema::create('iap_collection_sessions', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name', 50)->nullable();
            $t->integer('sorting')->default(0);
            $t->string('focus', 100)->nullable();
            $t->timestamps();

            $t->integer('collection_id')->unsigned()->default(0);
            $t->integer('session_id')->unsigned()->default(0);
            $t->integer('sessionitemset_id')->unsigned()->nullable();

            $t->foreign('collection_id')
                ->references('id')
                ->on('iap_collections')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('session_id')
                ->references('id')
                ->on('iap_sessions')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('sessionitemset_id')
                ->references('id')
                ->on('iap_sessionitemsets')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_collection_versions
        Schema::create('iap_collection_versions', function (Blueprint $t) {
            $t->increments('id');
            $t->timestamps();

            $t->integer('collection_id')->unsigned()->default(0);
            $t->integer('version_id')->unsigned()->default(0);

            $t->foreign('collection_id')
                ->references('id')
                ->on('iap_collections')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('version_id')
                ->references('id')
                ->on('iap_versions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // iap_block_sessions
        Schema::create('iap_block_sessions', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('sorting')->default(0);
            $t->text('conditions')->nullable();
            $t->text('notes')->nullable();
            $t->timestamps();

            $t->integer('block_id')->unsigned()->default(0);
            $t->integer('level_id')->unsigned()->default(0);
            $t->integer('session_id')->unsigned()->default(0);

            $t->foreign('block_id')
                ->references('id')
                ->on('iap_blocks')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('level_id')
                ->references('id')
                ->on('iap_levels')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('session_id')
                ->references('id')
                ->on('iap_sessions')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_block_session_charts
        Schema::create('iap_block_session_charts', function (Blueprint $t) {
            $t->increments('id');
            $t->timestamps();

            $t->integer('block_session_id')->unsigned()->default(0);
            $t->integer('chart_id')->unsigned()->default(0);
        
            $t->foreign('block_session_id')
                ->references('id')
                ->on('iap_block_sessions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $t->foreign('chart_id')
                ->references('id')
                ->on('iap_charts')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_subcollections
        Schema::create('iap_subcollections', function (Blueprint $t) {
            $t->increments('id');
            $t->timestamp('start')->nullable();
            $t->timestamps();

            $t->integer('collection_id')->unsigned()->default(0);
            $t->integer('facilitator_id')->unsigned()->default(0);
            $t->integer('simulator_id')->unsigned()->default(0);
            $t->integer('submission_id')->unsigned()->nullable();

            $t->foreign('collection_id')
                ->references('id')
                ->on('iap_collections')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('facilitator_id')
                ->references('id')
                ->on('iap_facilitators')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('simulator_id')
                ->references('id')
                ->on('iap_simulators')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('submission_id')
                ->references('id')
                ->on('iap_submissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // iap_candidate_subcollections
        Schema::create('iap_candidate_subcollections', function (Blueprint $t) {
            $t->increments('id');
            $t->tinyInteger('flight_planning')->nullable();
            $t->timestamp('medical_expiry')->nullable();
            $t->timestamp('rating_expiry')->nullable();
            $t->boolean('safety_pilot')->default(0);
            $t->timestamps();

            $t->integer('candidate_id')->unsigned()->default(0);
            $t->integer('candidaterole_id')->unsigned()->default(0);
            $t->integer('subcollection_id')->unsigned()->default(0);
            
            $t->foreign('candidate_id')
                ->references('id')
                ->on('iap_candidates')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('candidaterole_id')
                ->references('id')
                ->on('iap_candidateroles')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('subcollection_id')
                ->references('id')
                ->on('iap_subcollections')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // iap_certimages
        Schema::create('iap_certimages', function (Blueprint $t) {
            $t->increments('id');
            $t->enum('type', ['rating', 'medical'])->nullable();
            $t->string('image', 250)->nullable();
            $t->timestamps();

            $t->integer('candidate_subcollection_id')
                ->unsigned()->nullable();

            $t->foreign('candidate_subcollection_id')
                ->references('id')
                ->on('iap_candidate_subcollections')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // iap_subcollectionitems
        Schema::create('iap_subcollectionitems', function (Blueprint $t) {
            $t->increments('id');
            $t->timestamp('checked_at')->nullable();
            $t->time('timeindex')->nullable();
            $t->tinyInteger('automatic')->nullable();
            $t->timestamps();

            $t->integer('candidate_subcollection_id')->unsigned()->default(0);
            $t->integer('collectionitem_id')->unsigned()->default(0);
            $t->integer('collection_session_id')->unsigned()->nullable();

            $t->foreign('candidate_subcollection_id')
                ->references('id')
                ->on('iap_candidate_subcollections')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $t->foreign('collectionitem_id')
                ->references('id')
                ->on('iap_collectionitems')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('collection_session_id')
                ->references('id')
                ->on('iap_collection_sessions')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        // iap_subsessions
        Schema::create('iap_subsessions', function (Blueprint $t) {
            $t->increments('id');
            $t->timestamp('start')->nullable();
            $t->timestamp('end')->nullable();
            $t->enum('status', ['started', 'completed', 'signed'])->default('started');
            $t->time('progress')->default('00:00:00');
            $t->tinyInteger('xtraining')->default(0);
            $t->string('signature', 50)->nullable();
            $t->timestamps();

            $t->integer('collection_session_id')->unsigned()->default(0);
            $t->integer('facilitator_id')->unsigned()->default(0);
            $t->integer('session_id')->unsigned()->default(0);
            $t->integer('subcollection_id')->unsigned()->default(0);

            $t->foreign('collection_session_id')
                ->references('id')
                ->on('iap_collection_sessions')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('facilitator_id')
                ->references('id')
                ->on('iap_facilitators')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('session_id')
                ->references('id')
                ->on('iap_sessions')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('subcollection_id')
                ->references('id')
                ->on('iap_subcollections')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // iap_candidate_subsessions
        Schema::create('iap_candidate_subsessions', function (Blueprint $t) {
            $t->increments('id');
            $t->tinyInteger('result')->nullable();
            $t->text('comment')->nullable();
            $t->string('signature', 50)->nullable();
            $t->timestamps();

            $t->integer('candidate_id')->unsigned()->default(0);
            $t->integer('candidaterole_id')->unsigned()->default(0);
            $t->integer('subsession_id')->unsigned()->default(0);

            $t->foreign('candidate_id')
                ->references('id')
                ->on('iap_candidates')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('candidaterole_id')
                ->references('id')
                ->on('iap_candidateroles')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('subsession_id')
                ->references('id')
                ->on('iap_subsessions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // iap_markers
        Schema::create('iap_markers', function (Blueprint $t) {
            $t->increments('id');
            $t->time('timeindex')->nullable();
            $t->enum('type', ['drop', 'pf'])->nullable();
            $t->text('comment')->nullable();
            $t->timestamps();

            $t->integer('candidate_id')->unsigned()->nullable();
            $t->integer('candidaterole_id')->unsigned()->nullable();
            $t->integer('subsession_id')->unsigned()->default(0);

            $t->foreign('candidate_id')
                ->references('id')
                ->on('iap_candidates')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('candidaterole_id')
                ->references('id')
                ->on('iap_candidateroles')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('subsession_id')
                ->references('id')
                ->on('iap_subsessions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // iap_subblocks
        Schema::create('iap_subblocks', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('sorting')->default(0);
            $t->enum('status', ['normal', 'introduced', 'completed'])
                ->default('normal');
            $t->timestamps();

            $t->integer('block_id')->unsigned()->default(0);
            $t->integer('block_session_id')->unsigned()->nullable();
            $t->integer('subsession_id')->unsigned()->default(0);

            $t->foreign('block_id')
                ->references('id')
                ->on('iap_blocks')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('block_session_id')
                ->references('id')
                ->on('iap_block_sessions')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('subsession_id')
                ->references('id')
                ->on('iap_subsessions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // iap_subevents
        Schema::create('iap_subevents', function (Blueprint $t) {
            $t->increments('id');
            $t->time('start')->nullable();
            $t->time('end')->nullable();
            $t->integer('sorting')->default(0);
            $t->enum('status', ['normal', 'introduced', 'marked', 'retaken'])
                ->default('normal');
            $t->integer('retake_order')->nullable();
            $t->timestamps();

            $t->integer('block_event_id')->unsigned()->nullable();
            $t->integer('event_id')->unsigned()->default(0);
            $t->integer('subblock_id')->unsigned()->default(0);
            $t->integer('subevent_id')->unsigned()->nullable();

            $t->foreign('block_event_id')
                ->references('id')
                ->on('iap_block_events')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('event_id')
                ->references('id')
                ->on('iap_events')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('subblock_id')
                ->references('id')
                ->on('iap_subblocks')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $t->foreign('subevent_id')
                ->references('id')
                ->on('iap_subevents')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });

        // iap_candidate_subevents
        Schema::create('iap_candidate_subevents', function (Blueprint $t) {
            $t->increments('id');
            $t->smallInteger('au1')->default(3);
            $t->smallInteger('au2')->default(3);
            $t->smallInteger('au3')->default(3);
            $t->text('comment')->nullable();
            $t->tinyInteger('pf')->nullable();
            $t->timestamps();

            $t->integer('candidate_id')->unsigned()->default(0);
            $t->integer('candidaterole_id')->unsigned()->nullable();
            $t->integer('subevent_id')->unsigned()->default(0);

            $t->foreign('candidate_id')
                ->references('id')
                ->on('iap_candidates')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('candidaterole_id')
                ->references('id')
                ->on('iap_candidateroles')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('subevent_id')
                ->references('id')
                ->on('iap_subevents')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // iap_omissions
        Schema::create('iap_omissions', function (Blueprint $t) {
            $t->increments('id');
            $t->time('timeindex')->nullable();
            $t->text('comment')->nullable();
            $t->tinyInteger('pilotflying')->default(0);
            $t->timestamps();
            
            $t->integer('candidate_id')->unsigned()->default(0);
            $t->integer('checkitem_id')->unsigned()->default(0);
            $t->integer('checklist_id')->unsigned()->default(0);
            $t->integer('subevent_id')->unsigned()->default(0);

            $t->foreign('candidate_id')
                ->references('id')
                ->on('iap_candidates')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('checkitem_id')
                ->references('id')
                ->on('iap_checkitems')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('checklist_id')
                ->references('id')
                ->on('iap_checklists')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $t->foreign('subevent_id')
                ->references('id')
                ->on('iap_subevents')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // iap_approvals
        Schema::create('iap_approvals', function (Blueprint $t) {
            $t->increments('id');
            $t->timestamps();

            $t->integer('subsession_id')->unsigned()->default(0);
            $t->integer('user_id')->unsigned()->nullable();

            $t->foreign('subsession_id')
                ->references('id')
                ->on('iap_subsessions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $t->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('iap_approvals');
        Schema::drop('iap_omissions');
        Schema::drop('iap_candidate_subevents');
        Schema::drop('iap_subevents');
        Schema::drop('iap_subblocks');
        Schema::drop('iap_markers');
        Schema::drop('iap_candidate_subsessions');
        Schema::drop('iap_subsessions');
        Schema::drop('iap_subcollectionitems');
        Schema::drop('iap_certimages');
        Schema::drop('iap_candidate_subcollections');
        Schema::drop('iap_subcollections');
        Schema::drop('iap_block_session_charts');
        Schema::drop('iap_block_sessions');
        Schema::drop('iap_collection_versions');
        Schema::drop('iap_collection_sessions');
        Schema::drop('iap_sessionitems');
        Schema::drop('iap_sessionitemsets');
        Schema::drop('iap_checklist_events');
        Schema::drop('iap_block_events');
        Schema::drop('iap_checkitems');
        Schema::drop('iap_opcbriefs');
        Schema::drop('iap_collection_collectionitemsets');
        Schema::drop('iap_collectionitems');
        Schema::drop('iap_collectionitemsets');
        Schema::drop('iap_collections');
        Schema::drop('iap_submissions');
        Schema::drop('iap_facilitators');
        Schema::drop('iap_events');
        Schema::drop('iap_checklists');
        Schema::drop('iap_docrevisions');
        Schema::drop('iap_documents');
        Schema::drop('iap_candidates');
        Schema::drop('iap_versions');
        Schema::drop('iap_simulators');
        Schema::drop('iap_sessions');
        Schema::drop('iap_levels');
        Schema::drop('iap_helicoptertypes');
        Schema::drop('iap_eventtypes');
        Schema::drop('iap_error_codes');
        Schema::drop('iap_collectiontypes');
        Schema::drop('iap_checktypes');
        Schema::drop('iap_charts');
        Schema::drop('iap_candidateroles');
        Schema::drop('iap_blocks');
    }
}
