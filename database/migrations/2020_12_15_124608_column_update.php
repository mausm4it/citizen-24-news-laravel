<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use DB as DBS;

class ColumnUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     *
     * @return void
     */
    public function up()
    {
        DBS::statement('SET FOREIGN_KEY_CHECKS=0;');

        // update V102
        if (!Schema::hasColumn('users', 'is_user_banned')):
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_user_banned')->default(1)->comment('0 banned, 1 unbanned');
            });
        endif;
        if (!Schema::hasColumn('users', 'user_banned_reason')):
            Schema::table('users', function (Blueprint $table) {
                $table->text('user_banned_reason')->nullable();
            });
        endif;
        if (!Schema::hasColumn('users', 'is_subscribe_banned')):
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_subscribe_banned')->default(1)->comment('0 banned, 1 unbanned');
            });
        endif;
        if (!Schema::hasColumn('users', 'subscribe_banned_reason')):
            Schema::table('users', function (Blueprint $table) {
                $table->text('subscribe_banned_reason')->nullable();
            });
        endif;
        if (!Schema::hasColumn('users', 'about_us')):
            Schema::table('users', function (Blueprint $table) {
                $table->text('about_us')->nullable();
            });
        endif;
        if (!Schema::hasColumn('users', 'social_media')):
            Schema::table('users', function (Blueprint $table) {
                $table->longText('social_media')->nullable()->comment('it will be array data');
            });
        endif;
        if (!Schema::hasColumn('users', 'is_active')):
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_active')->default(1)->comment('0 inactive user, 1 active user');
            });
        endif;
        if (!Schema::hasColumn('users', 'deactivate_reason')):
            Schema::table('users', function (Blueprint $table) {
                $table->text('deactivate_reason')->nullable();
            });
        endif;
        if (!Schema::hasColumn('users', 'firebase_auth_id')):
            Schema::table('users', function (Blueprint $table) {
                $table->integer('firebase_auth_id')->unsigned()->nullable()->default(null)->comment('this is for mobile app.');
            });
        endif;

        // update v103
        Schema::table('users', function (Blueprint $table) {
            $table->longText('permissions')->comment('it will be array data')->change();
            $table->string('profile_image')->after('last_name')->nullable();
        });

        Schema::table('menu_item', function (Blueprint $table) {
            $table->bigInteger('sub_category_id')->after('category_id')->nullable()->unsigned()->default(null);

            $table->foreign('sub_category_id')->references('id')->on('sub_categories')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->longText('contents')->after('total_hit')->nullable()->comment('extra content');
            $table->text('read_more_link')->after('contents')->nullable()->comment('rss post actual link');

            $table->index(['visibility','status','slider','language','auth_required']);
            $table->index(['featured','breaking','recommended','editor_picks','tags']);
            $table->index(['recommended_order','featured_order','id']);
            $table->index(['post_type','video_url_type','total_hit']);
            $table->index(['created_at','updated_at']);
            $table->index(['user_id','category_id']) ;
            $table->index(['sub_category_id','video_thumbnail_id']) ;
        });

        Schema::table('widgets', function (Blueprint $table) {
            $table->bigInteger('poll_id')->after('ad_id')->nullable()->unsigned()->default(null);
            $table->foreign('poll_id')->references('id')->on('polls')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        DB::table('permissions')->insert([
            'name' => 'album',
            'slug' => 'album_read',
            'description' => '',
        ]);

        DB::table('permissions')->insert([
            'name' => 'album',
            'slug' => 'album_write',
            'description' => '',
        ]);

        DB::table('permissions')->insert([
            'name' => 'album',
            'slug' => 'album_delete',
            'description' => '',
        ]);

        DB::table('permissions')->insert([
            'name' => 'rss',
            'slug' => 'rss_read',
            'description' => '',
        ]);

        DB::table('permissions')->insert([
            'name' => 'rss',
            'slug' => 'rss_write',
            'description' => '',
        ]);

        DB::table('permissions')->insert([
            'name' => 'rss',
            'slug' => 'rss_delete',
            'description' => '',
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_image');
        });

        Schema::table('menu_item', function (Blueprint $table) {
            $table->dropForeign('menu_item_sub_category_id_foreign');
            $table->dropColumn('sub_category_id');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('contents');
            $table->dropColumn('read_more_link');

            $table->dropIndex(['visibility','status','slider','language','auth_required']);

            $table->dropIndex(['recommended_order','featured_order','id']);

            $table->dropIndex(['featured','breaking','recommended','editor_picks','tags']);
            $table->dropIndex(['post_type','video_url_type','total_hit']);
            $table->dropIndex(['created_at','updated_at']);

            $table->dropForeign(['user_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['sub_category_id']);
            $table->dropForeign(['video_thumbnail_id']);

            $table->dropIndex('posts_user_id_category_id_index') ;
            $table->dropIndex('posts_sub_category_id_video_thumbnail_id_index') ;
        });

        Schema::table('widgets', function (Blueprint $table) {
            $table->dropForeign('widgets_poll_id_foreign');
            $table->dropColumn('poll_id');
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
        ];
    }
}
