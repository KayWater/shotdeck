<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('genres')->insert([
            'name' => '剧情',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '喜剧',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '动作',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '爱情',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '科幻',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '动画',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '悬疑',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '惊悚',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '恐怖',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '犯罪',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '同性',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '音乐',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '歌舞',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '传记',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '历史',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '战争',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '西部',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '奇幻',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '冒险',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '灾难',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '武侠',
            'status' => 1,
        ]);

        DB::table('genres')->insert([
            'name' => '情色',
            'status' => 1,
        ]);
    }
}
