<?php namespace Winter\Test\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class RenameTables extends Migration
{
    const TABLES = [
        'attributes',
        'categories',
        'channels',
        'cities',
        'comments',
        'countries',
        'countries_types',
        'galleries',
        'gallery_entity',
        'locations',
        'members',
        'meta',
        'pages',
        'people',
        'people_roles',
        'phones',
        'plugins',
        'posts',
        'posts_tags',
        'related_channels',
        'reviews',
        'roles',
        'tags',
        'themes',
        'users',
        'users_roles',
    ];

    public function up()
    {
        foreach (self::TABLES as $table) {
            $from = 'rainlab_translate_' . $table;
            $to   = 'winter_translate_' . $table;
            if (Schema::hasTable($from) && !Schema::hasTable($to)) {
                Schema::rename($from, $to);
            }
        }
    }

    public function down()
    {
        foreach (self::TABLES as $table) {
            $from = 'winter_translate_' . $table;
            $to   = 'rainlab_translate_' . $table;
            if (Schema::hasTable($from) && !Schema::hasTable($to)) {
                Schema::rename($from, $to);
            }
        }
    }
}
