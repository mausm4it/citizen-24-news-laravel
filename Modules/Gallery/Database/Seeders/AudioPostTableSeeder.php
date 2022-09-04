<?php

namespace Modules\Gallery\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class AudioPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO audio_post (id, post_id, audio_id, created_at, updated_at) VALUES
             (1, 8, 2, '2020-12-17 12:37:33', '2020-12-17 12:37:33'),
(2, 23, 1, '2020-12-17 12:37:33', '2020-12-17 12:37:33'),
(3, 24, 4, '2020-12-17 12:37:45', '2020-12-17 12:37:45'),
(4, 24, 3, '2020-12-17 12:37:45', '2020-12-17 12:37:45'),
(5, 25, 3, '2020-12-17 12:38:02', '2020-12-17 12:38:02'),
(6, 25, 4, '2020-12-17 12:38:02', '2020-12-17 12:38:02'),
(7, 25, 5, '2020-12-17 12:38:02', '2020-12-17 12:38:02'),
(8, 33, 3, '2020-12-17 12:38:17', '2020-12-17 12:38:17'),
(9, 33, 4, '2020-12-17 12:38:17', '2020-12-17 12:38:17'),
(10, 33, 5, '2020-12-17 12:38:17', '2020-12-17 12:38:17'),
(11, 34, 2, '2020-12-17 12:38:48', '2020-12-17 12:38:48'),
(12, 34, 4, '2020-12-17 12:38:48', '2020-12-17 12:38:48'),
(13, 34, 3, '2020-12-17 12:38:48', '2020-12-17 12:38:48'),
(14, 35, 5, '2020-12-17 12:39:06', '2020-12-17 12:39:06'),
(15, 35, 1, '2020-12-17 12:39:06', '2020-12-17 12:39:06'),
(16, 35, 2, '2020-12-17 12:39:06', '2020-12-17 12:39:06'),
(17, 43, 3, '2020-12-17 12:39:34', '2020-12-17 12:39:34'),
(18, 43, 2, '2020-12-17 12:39:34', '2020-12-17 12:39:34'),
(19, 43, 1, '2020-12-17 12:39:34', '2020-12-17 12:39:34'),
(20, 44, 3, '2020-12-17 12:39:51', '2020-12-17 12:39:51'),
(21, 44, 4, '2020-12-17 12:39:51', '2020-12-17 12:39:51'),
(22, 44, 5, '2020-12-17 12:39:51', '2020-12-17 12:39:51'),
(23, 45, 3, '2020-12-17 12:40:04', '2020-12-17 12:40:04'),
(24, 45, 2, '2020-12-17 12:40:04', '2020-12-17 12:40:04'),
(25, 45, 1, '2020-12-17 12:40:04', '2020-12-17 12:40:04'),
(26, 53, 2, '2020-12-17 12:37:33', '2020-12-17 12:37:33'),
(27, 53, 1, '2020-12-17 12:37:33', '2020-12-17 12:37:33'),
(28, 53, 4, '2020-12-17 12:37:45', '2020-12-17 12:37:45'),
(29, 54, 3, '2020-12-17 12:37:45', '2020-12-17 12:37:45'),
(30, 54, 3, '2020-12-17 12:38:02', '2020-12-17 12:38:02'),
(31, 54, 4, '2020-12-17 12:38:02', '2020-12-17 12:38:02'),
(32, 55, 5, '2020-12-17 12:38:02', '2020-12-17 12:38:02'),
(33, 55, 3, '2020-12-17 12:38:17', '2020-12-17 12:38:17'),
(34, 63, 4, '2020-12-17 12:38:17', '2020-12-17 12:38:17'),
(35, 63, 5, '2020-12-17 12:38:17', '2020-12-17 12:38:17'),
(36, 63, 2, '2020-12-17 12:38:48', '2020-12-17 12:38:48'),
(37, 63, 4, '2020-12-17 12:38:48', '2020-12-17 12:38:48'),
(38, 63, 3, '2020-12-17 12:38:48', '2020-12-17 12:38:48'),
(39, 64, 5, '2020-12-17 12:39:06', '2020-12-17 12:39:06'),
(40, 64, 1, '2020-12-17 12:39:06', '2020-12-17 12:39:06'),
(41, 64, 2, '2020-12-17 12:39:06', '2020-12-17 12:39:06'),
(42, 64, 3, '2020-12-17 12:39:34', '2020-12-17 12:39:34'),
(43, 65, 2, '2020-12-17 12:39:34', '2020-12-17 12:39:34'),
(44, 65, 1, '2020-12-17 12:39:34', '2020-12-17 12:39:34'),
(45, 65, 3, '2020-12-17 12:39:51', '2020-12-17 12:39:51'),
(46, 65, 4, '2020-12-17 12:39:51', '2020-12-17 12:39:51'),
(47, 65, 5, '2020-12-17 12:39:51', '2020-12-17 12:39:51'),
(48, 73, 1, '2020-12-17 12:39:51', '2020-12-17 12:39:51'),
(49, 74, 2, '2020-12-17 12:39:51', '2020-12-17 12:39:51'),
(50, 75, 3, '2020-12-17 12:39:51', '2020-12-17 12:39:51')");

        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
