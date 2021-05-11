<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('regions')->insert([
            'name' => '欧美',
            'status' => 1,
        ]);

        DB::table('regions')->insert([
            'name' => '好莱坞',
            'status' => 1,
        ]);

        DB::table('regions')->insert([
            'name' => '中国',
            'status' => 1,
        ]);

        DB::table('regions')->insert([
            'name' => '日韩',
            'status' => 1,
        ]);

        DB::table('regions')->insert([
            'name' => '亚洲',
            'status' => 1,
        ]);

        DB::table('regions')->insert([
            'name' => '其他',
            'status' => 1,
        ]);
    }
}
