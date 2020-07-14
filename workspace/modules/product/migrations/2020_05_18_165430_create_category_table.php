<?php

use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App::$db->schema->create('category', function (Blueprint $table) {
            $table->string('id',255);
            $table->string('name', 255);
            $table->string('title',255);
            $table->text('description');
            $table->string('slug',255);
            $table->integer('left_key');
            $table->integer('right_key');
            $table->integer('level');
            $table->tinyInteger('status');
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
        App::$db->schema->dropIfExists('category');
    }
}
