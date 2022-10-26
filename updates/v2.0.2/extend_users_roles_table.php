<?php namespace Winter\Test\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class ExtendUsersRolesTable extends Migration
{
    public function up()
    {
        Schema::table('winter_test_users_roles', function($table)
        {
            $table->json('awards')->nullable();
        });
	}
    
    public function down()
    {
        Schema::table('winter_test_users_roles', function($table)
        {
            $table->dropColumn('awards');
        });     
    }
}