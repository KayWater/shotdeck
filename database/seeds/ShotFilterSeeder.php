<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShotFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('shot_filters')->insert([
            'id' => 1,
            'name' => '色彩',
            'parent_id' => 0,
            'level' => 1,
            'path' => '-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 2,
            'name' => '红',
            'parent_id' => 1,
            'level' => 2,
            'path' => '-1-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 3,
            'name' => '黄',
            'parent_id' => 1,
            'level' => 2,
            'path' => '-1-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 4,
            'name' => '橙',
            'parent_id' => 1,
            'level' => 2,
            'path' => '-1-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 5,
            'name' => '蓝',
            'parent_id' => 1,
            'level' => 2,
            'path' => '-1-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 6,
            'name' => '绿',
            'parent_id' => 1,
            'level' => 2,
            'path' => '-1-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 7,
            'name' => '紫',
            'parent_id' => 1,
            'level' => 2,
            'path' => '-1-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shot_filters')->insert([
            'id' => 8,
            'name' => '色系',
            'parent_id' => 0,
            'level' => 1,
            'path' => '-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 9,
            'name' => '冷色',
            'parent_id' => 8,
            'level' => 2,
            'path' => '-8-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 10,
            'name' => '暖色',
            'parent_id' => 8,
            'level' => 2,
            'path' => '-8-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shot_filters')->insert([
            'id' => 11,
            'name' => '一天中的时段',
            'parent_id' => 0,
            'level' => 1,
            'path' => '-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 12,
            'name' => '黎明前',
            'parent_id' => 11,
            'level' => 2,
            'path' => '-11-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 13,
            'name' => '黎明',
            'parent_id' => 11,
            'level' => 2,
            'path' => '-11-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 14,
            'name' => '清晨',
            'parent_id' => 11,
            'level' => 2,
            'path' => '-11-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 15,
            'name' => '上午',
            'parent_id' => 11,
            'level' => 2,
            'path' => '-11-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 16,
            'name' => '中午',
            'parent_id' => 11,
            'level' => 2,
            'path' => '-11-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 17,
            'name' => '下午',
            'parent_id' => 11,
            'level' => 2,
            'path' => '-11-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 18,
            'name' => '傍晚',
            'parent_id' => 11,
            'level' => 2,
            'path' => '-11-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 19,
            'name' => '夜晚',
            'parent_id' => 11,
            'level' => 2,
            'path' => '-11-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 20,
            'name' => '深夜',
            'parent_id' => 11,
            'level' => 2,
            'path' => '-11-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 21,
            'name' => '凌晨',
            'parent_id' => 11,
            'level' => 2,
            'path' => '-11-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shot_filters')->insert([
            'id' => 22,
            'name' => '灯光类型',
            'parent_id' => 0,
            'level' => 1,
            'path' => '-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 23,
            'name' => '高调',
            'parent_id' => 22,
            'level' => 2,
            'path' => '-22-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 24,
            'name' => '低调',
            'parent_id' => 22,
            'level' => 2,
            'path' => '-22-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 25,
            'name' => '高反差',
            'parent_id' => 22,
            'level' => 2,
            'path' => '-22-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 26,
            'name' => '背光',
            'parent_id' => 22,
            'level' => 2,
            'path' => '-22-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 27,
            'name' => '曝光过度',
            'parent_id' => 22,
            'level' => 2,
            'path' => '-22-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shot_filters')->insert([
            'id' => 28,
            'name' => '照明类型',
            'parent_id' => 0,
            'level' => 1,
            'path' => '-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 29,
            'name' => '户外自然',
            'parent_id' => 28,
            'level' => 2,
            'path' => '-28-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 30,
            'name' => '户外人工',
            'parent_id' => 28,
            'level' => 2,
            'path' => '-28-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 31,
            'name' => '室内自然',
            'parent_id' => 28,
            'level' => 2,
            'path' => '-28-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 32,
            'name' => '室内人工',
            'parent_id' => 28,
            'level' => 2,
            'path' => '-28-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shot_filters')->insert([
            'id' => 33,
            'name' => '景别',
            'parent_id' => 0,
            'level' => 1,
            'path' => '-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 34,
            'name' => '大远景',
            'parent_id' => 33,
            'level' => 2,
            'path' => '-33-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 35,
            'name' => '远景',
            'parent_id' => 33,
            'level' => 2,
            'path' => '-33-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 36,
            'name' => '全景',
            'parent_id' => 33,
            'level' => 2,
            'path' => '-33-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 37,
            'name' => '中景',
            'parent_id' => 33,
            'level' => 2,
            'path' => '-33-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 38,
            'name' => '特写',
            'parent_id' => 33,
            'level' => 2,
            'path' => '-33-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 39,
            'name' => '大特写',
            'parent_id' => 33,
            'level' => 2,
            'path' => '-33-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 40,
            'name' => '深焦镜头',
            'parent_id' => 33,
            'level' => 2,
            'path' => '-33-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shot_filters')->insert([
            'id' => 41,
            'name' => '摄像机角度',
            'parent_id' => 0,
            'level' => 1,
            'path' => '-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 42,
            'name' => '鸟瞰',
            'parent_id' => 41,
            'level' => 2,
            'path' => '-41-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 43,
            'name' => '俯视',
            'parent_id' => 41,
            'level' => 2,
            'path' => '-41-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 44,
            'name' => '水平',
            'parent_id' => 41,
            'level' => 2,
            'path' => '-41-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 45,
            'name' => '90°仰视',
            'parent_id' => 41,
            'level' => 2,
            'path' => '-41-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 46,
            'name' => '仰视',
            'parent_id' => 41,
            'level' => 2,
            'path' => '-41-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 47,
            'name' => '倾斜',
            'parent_id' => 41,
            'level' => 2,
            'path' => '-41-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shot_filters')->insert([
            'id' => 48,
            'name' => '摄像机运动',
            'parent_id' => 0,
            'level' => 1,
            'path' => '-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 49,
            'name' => '定',
            'parent_id' => 48,
            'level' => 2,
            'path' => '-48-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 50,
            'name' => '跟拍',
            'parent_id' => 48,
            'level' => 2,
            'path' => '-48-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 51,
            'name' => '推轨',
            'parent_id' => 48,
            'level' => 2,
            'path' => '-48-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 52,
            'name' => '横摇',
            'parent_id' => 48,
            'level' => 2,
            'path' => '-48-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 53,
            'name' => '上下直摇',
            'parent_id' => 48,
            'level' => 2,
            'path' => '-48-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 54,
            'name' => '升降镜头',
            'parent_id' => 48,
            'level' => 2,
            'path' => '-48-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 55,
            'name' => '伸缩镜头',
            'parent_id' => 48,
            'level' => 2,
            'path' => '-48-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 56,
            'name' => '手提摄影',
            'parent_id' => 48,
            'level' => 2,
            'path' => '-48-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 57,
            'name' => '空中摇摄',
            'parent_id' => 48,
            'level' => 2,
            'path' => '-48-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 58,
            'name' => '俯视旋转',
            'parent_id' => 48,
            'level' => 2,
            'path' => '-48-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shot_filters')->insert([
            'id' => 59,
            'name' => '镜头语言',
            'parent_id' => 0,
            'level' => 1,
            'path' => '-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 60,
            'name' => '无',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 61,
            'name' => '发现',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 62,
            'name' => '后拉撤回',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 63,
            'name' => '后拉揭示',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 64,
            'name' => '扩展',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 65,
            'name' => '精简',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 66,
            'name' => '紧缩',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 67,
            'name' => '引出',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 68,
            'name' => '环绕',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 69,
            'name' => '飞越',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 70,
            'name' => '纵深移动',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 71,
            'name' => '移动上摇',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 72,
            'name' => '移动俯摇',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 73,
            'name' => '环绕观看',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 74,
            'name' => '穿越固体',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 75,
            'name' => '眩晕',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 76,
            'name' => '延伸移动',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 77,
            'name' => '收缩移动',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 78,
            'name' => '倒退移动',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 79,
            'name' => '长镜头',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 80,
            'name' => '延时揭示',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 81,
            'name' => '升格',
            'parent_id' => 59,
            'level' => 2,
            'path' => '-59-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shot_filters')->insert([
            'id' => 82,
            'name' => '画面比例',
            'parent_id' => 0,
            'level' => 1,
            'path' => '-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 83,
            'name' => '16：9',
            'parent_id' => 82,
            'level' => 2,
            'path' => '-82-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 84,
            'name' => '4：3',
            'parent_id' => 82,
            'level' => 2,
            'path' => '-82-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 85,
            'name' => '2.35：1',
            'parent_id' => 82,
            'level' => 2,
            'path' => '-82-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 86,
            'name' => '2.39：1',
            'parent_id' => 82,
            'level' => 2,
            'path' => '-82-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('shot_filters')->insert([
            'id' => 87,
            'name' => '影片类型',
            'parent_id' => 0,
            'level' => 1,
            'path' => '-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 88,
            'name' => '剧情',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 89,
            'name' => '喜剧',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 90,
            'name' => '动作',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 91,
            'name' => '爱情',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 92,
            'name' => '科幻',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 93,
            'name' => '动画',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 94,
            'name' => '悬疑',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 95,
            'name' => '惊悚',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 96,
            'name' => '恐怖',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 97,
            'name' => '犯罪',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 98,
            'name' => '同性',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 99,
            'name' => '音乐',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 100,
            'name' => '歌舞',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 101,
            'name' => '传记',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 102,
            'name' => '历史',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 103,
            'name' => '战争',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 104,
            'name' => '西部',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 105,
            'name' => '奇幻',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 106,
            'name' => '冒险',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 107,
            'name' => '灾难',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 108,
            'name' => '武侠',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('shot_filters')->insert([
            'id' => 109,
            'name' => '情色',
            'parent_id' => 87,
            'level' => 2,
            'path' => '-87-',
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
