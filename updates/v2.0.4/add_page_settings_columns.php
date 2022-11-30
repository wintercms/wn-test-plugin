<?php namespace Winter\Test\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::table('winter_test_pages', function ($table) {
            $table->boolean('enabled')->default(false)->after('content');
            $table->boolean('hidden')->default(false)->after('enabled');
        });
    }

    public function down()
    {
        Schema::table('winter_test_pages', function ($table) {
            $table->dropColumn([
                'enabled',
                'hidden',
            ]);
        });
    }
};
