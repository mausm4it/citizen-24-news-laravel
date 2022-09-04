<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use DB as DBS;

class ColumnUpdate2nd extends Migration
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

        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('is_featured')->comment('0 for not, 1 for featured')->after('slug');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_password_set')->default(0)->comment('0 not set, 1 set')->after('is_user_banned');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->after('email');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->date('dob')->comment('date of birth')->after('phone');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('gender')->comment('1 male, 2 female, 3 others')->after('dob');
        });

        DB::statement("ALTER TABLE posts MODIFY COLUMN post_type ENUM('article', 'video', 'audio', 'trivia-quiz', 'personality-quiz')");

        DB::table('permissions')->insert([
            'name' => 'api',
            'slug' => 'api_read',
            'description' => '',
        ]);

        DB::table('permissions')->insert([
            'name' => 'api',
            'slug' => 'api_write',
            'description' => '',
        ]);

        DB::table('permissions')->insert([
            'name' => 'api',
            'slug' => 'api_delete',
            'description' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'api_key_for_app',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'latest_apk_version',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'latest_apk_code',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'apk_file_url',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'whats_new_on_latest_apk',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'apk_update_skipable_status',
            'value' => 'false',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'latest_ipa_version',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'latest_ipa_code',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'ipa_file_url',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'whats_new_on_latest_ipa',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'ios_update_skipable_status',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'mandatory_login',
            'value' => 'false',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'intro_skippable',
            'value' => 'false',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'privacy_policy_url',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'terms_n_condition_url',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'support_url',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'ads_enable',
            'value' => 'false',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'mobile_ads_network',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'admob_app_id',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'admob_banner_ads_id',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'admob_interstitial_ads_id',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'admob_native_ads_id',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'fan_native_ads_placement_id',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'fan_banner_ads_placement_id',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'fan_interstitial_ads_placement_id',
            'value' => '',
            'lang' => $default_language,
        ]);

        DB::table('settings')->insert([
            'title' => 'startapp_app_id',
            'value' => '',
            'lang' => $default_language,
        ]);

        $superAdmin = DB::table('roles')->where('id', 1)->update([
            'permissions' => $this->getAdminRolePermissions()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_password_set');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('dob');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('gender');
        });
    }

    private function getAdminRolePermissions()
    {
        return [
            // permissions

            "users_read" => true,
            "users_write" => true,
            "users_delete" => true,

            "settings_read" => true,
            "settings_write" => true,
            "settings_delete" => true,

            "role_read" => true,
            "role_write" => true,
            "role_delete" => true,

            "permission_read" => true,
            "permission_write" => true,
            "permission_delete" => true,

            "language_settings_read" => true,
            "language_settings_write" => true,
            "language_settings_delete" => true,

            "pages_read" => true,
            "pages_write" => true,
            "pages_delete" => true,

            "menu_read" => true,
            "menu_write" => true,
            "menu_delete" => true,

            "menu_item_read" => true,
            "menu_item_write" => true,
            "menu_item_delete" => true,

            "post_read" => true,
            "post_write" => true,
            "post_delete" => true,

            "category_read" => true,
            "category_write" => true,
            "category_delete" => true,

            "sub_category_read" => true,
            "sub_category_write" => true,
            "sub_category_delete" => true,

            "widget_read" => true,
            "widget_write" => true,
            "widget_delete" => true,

            "newsletter_read" => true,
            "newsletter_write" => true,
            "newsletter_delete" => true,

            "notification_read" => true,
            "notification_write" => true,
            "notification_delete" => true,

            "contact_message_read" => true,
            "contact_message_write" => true,
            "contact_message_delete" => true,

            "ads_read" => true,
            "ads_write" => true,
            "ads_delete" => true,

            "theme_section_read" => true,
            "theme_section_write" => true,
            "theme_section_delete" => true,

            "polls_read" => true,
            "polls_write" => true,
            "polls_delete" => true,

            "socials_read" => true,
            "socials_write" => true,
            "socials_delete" => true,

            "comments_read" => true,
            "comments_write" => true,
            "comments_delete" => true,

            "album_read" => true,
            "album_write" => true,
            "album_delete" => true,

            "rss_read" => true,
            "rss_write" => true,
            "rss_delete" => true,

            "api_read" => true,
            "api_write" => true,
            "api_delete" => true,
        ];
    }
}
