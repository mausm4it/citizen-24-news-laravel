<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use DB as DBS;

class VersionUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Cache::Flush();

        DBS::statement('SET FOREIGN_KEY_CHECKS=0;');

        $default_language   = settingHelper('default_language') ?? 'en';

        if (settingHelper('version') == ''):
            // version add in settings
            DB::table('settings')->insert([
                'title' => 'version',
                'value' => 121,
                'lang' => $default_language,
            ]);
        else:
            DB::table('settings')->where('title', 'version')->update([
                'value' => 121
            ]);
        endif;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
