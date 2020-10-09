<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->integer('language_id');
            $table->string('title');
            $table->text('slug');
            $table->text('description');
            $table->integer('year_of_release');
            $table->integer('show_time')->comment('time in minutes');
            $table->integer('age_group')->comment('age in year');
            $table->text('director');
            $table->text('starrring');
            $table->string('image1');
            $table->string('image2');
            $table->string('video_file');
            $table->string('trailer_video_file');
            $table->integer('status')->default(1);
            $table->integer('type')->comment('1->free,2->premium,3->pay per click');
            $table->integer('is_top_10')->default(0)->comment('1->top 10');
            $table->integer('is_must_watch')->default(0)->comment('1->must watch');
            $table->integer('is_family')->default(0)->comment('1->is family');
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shows');
    }
}
