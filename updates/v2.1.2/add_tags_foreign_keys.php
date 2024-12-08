<?php

use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

return new class extends Migration
{
    public function up()
    {   
        Schema::table('winter_test_tags', function (Blueprint $table) {
            $table->foreignId('record_id')->index()->nullable();
            $table->nullableMorphs('taggable', 'morphable_index');
        });
    }

    public function down()
    {   
        Schema::table('winter_test_tags', function ($table) {
            $table->dropColumn('record_id');
            $table->dropMorphs('taggable', 'morphable_index');
        });
    }
};
