<?php namespace Winter\Test\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::table('winter_test_pages', function ($table) {
            $table->string('title')->nullable()->after('id');
            $table->string('slug')->nullable()->after('title');
        });
    }

    public function down()
    {
        Schema::table('winter_test_pages', function ($table) {
            $table->dropColumn([
                'title',
                'slug',
            ]);
        });
    }
};
