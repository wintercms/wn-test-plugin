<?php

namespace Winter\Test\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::table('winter_test_records', function ($table) {
            $table->mediumText('content_grid')->nullable()->after('content');
        });
    }

    public function down()
    {
        Schema::table('winter_test_records', function ($table) {
            $table->dropColumn('content_grid');
        });
    }
};
