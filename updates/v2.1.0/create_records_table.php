<?php namespace Winter\Test\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('winter_test_records', function ($table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned()->nullable()->index();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('status')->default('draft');
            $table->mediumText('content')->nullable();
            $table->mediumText('additional_data')->nullable();
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('winter_test_records');
    }
};
