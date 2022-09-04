<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use DB as DBS;

class VersionControl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DBS::statement('SET FOREIGN_KEY_CHECKS=0;');

        $default_language   = settingHelper('default_language') ?? 'en';

        if (settingHelper('version') == ''):
            // version add in settings
            DB::table('settings')->insert([
                'title' => 'version',
                'value' => 120,
                'lang' => $default_language,
            ]);
        else:
            DB::table('settings')->where('title', 'version')->update([
                'value' => 120
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
