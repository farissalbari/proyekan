<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsHasLanguageTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'posts_has_language';

    /**
     * Run the migrations.
     * @table posts_has_language
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('posts_id');
            $table->string('language_id');

            $table->index(["language_id"], 'fk_posts_has_language_language1_idx');

            $table->index(["posts_id"], 'fk_posts_has_language_posts1_idx');


            $table->foreign('posts_id', 'fk_posts_has_language_posts1_idx')
                ->references('id')->on('posts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('language_id', 'fk_posts_has_language_language1_idx')
                ->references('id')->on('language')
                ->onDelete('no action')
                ->onUpdate('no action');

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
       Schema::dropIfExists($this->set_schema_table);
     }
}
