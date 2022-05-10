<?php namespace Winter\Test\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class ModifyLocationsTable extends Migration
{
    public function up()
    {
        Schema::table('winter_test_locations', function ($table) {
            $table->unsignedinteger('sort_order')->nullable()->index()->default(1);
        });
    }

    public function down()
    {
        if (Schema::hasColumn('winter_test_locations', 'sort_order')) {
            Schema::table('winter_test_locations', function ($table) {
                $table->dropColumn('sort_order');
            });
        }
    }
}
