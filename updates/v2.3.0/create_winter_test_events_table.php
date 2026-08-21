<?php namespace Winter\Test\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

/**
 * Creates the events table used to demonstrate and test the CalendarController behavior.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::create('winter_test_events', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable();
            $table->boolean('all_day')->default(false);
            $table->string('color')->nullable();
            $table->string('rrule')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('winter_test_events');
    }
};
