<?php

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\PropertyValue;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $property = Property::create([
            'name' => '角色性别',
            'parent_id' => 0,
            'status' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '无',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '一男',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '一女',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '两男',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '两女',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '一男一女',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '多人',
            'status' => 1,
            'order' => 1
        ]);

        $property = Property::create([
            'name' => '色彩',
            'parent_id' => 0,
            'status' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '红色',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '黄色',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '橙色',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '蓝色',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '绿色',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '紫色',
            'status' => 1,
            'order' => 1
        ]);

        $property = Property::create([
            'name' => '色系',
            'parent_id' => 0,
            'status' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '冷色',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '暖色',
            'status' => 1,
            'order' => 1
        ]);

        $property = Property::create([
            'name' => '一天中的时段',
            'parent_id' => 0,
            'status' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '黎明前',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '黎明',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '清晨',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '上午',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '中午',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '下午',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '傍晚',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '夜晚',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '深夜',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '凌晨',
            'status' => 1,
            'order' => 1
        ]);

        $property = Property::create([
            'name' => '灯光类型',
            'parent_id' => 0,
            'status' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '高调',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '低调',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '高反差',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '背光',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '曝光过度',
            'status' => 1,
            'order' => 1
        ]);

        $property = Property::create([
            'name' => '照明类型',
            'parent_id' => 0,
            'status' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '户外自然',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '户外人工',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '室内自然',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '室内人工',
            'status' => 1,
            'order' => 1
        ]);
        
        $property = Property::create([
            'name' => '景别',
            'parent_id' => 0,
            'status' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '大远景',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '远景',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '全景',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '中景',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '近景',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '特写',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '大特写',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '深焦',
            'status' => 1,
            'order' => 1
        ]);

        $property = Property::create([
            'name' => '摄像机角度',
            'parent_id' => 0,
            'status' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '鸟瞰',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '俯视',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '水平',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '90°仰视',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '仰视',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '倾斜',
            'status' => 1,
            'order' => 1
        ]);

        $property = Property::create([
            'name' => '摄像机运动',
            'parent_id' => 0,
            'status' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '定',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '跟拍',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '推轨',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '后拉',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '横移',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '横摇',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '上下直摇',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '升降镜头',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '伸缩镜头',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '手提摄影',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '空中摇摄',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '俯视旋转',
            'status' => 1,
            'order' => 1
        ]);

        $property = Property::create([
            'name' => '镜头语言',
            'parent_id' => 0,
            'status' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '无',
            'status' => 1,
            'order' => 1
        ]);

        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '发现',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '后拉撤回',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '后拉揭示',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '扩展',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '精简',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '紧缩',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '引出',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '环绕',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '飞越',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '纵深移动',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '移动上摇',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '移动俯摇',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '环绕观看',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '穿越固体',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '眩晕',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '延伸移动',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '收缩移动',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '倒退移动',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '长镜头',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '延时揭示',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '升格',
            'status' => 1,
            'order' => 1
        ]);

        $property = Property::create([
            'name' => '画面比例',
            'parent_id' => 0,
            'status' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '16:9',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '4:3',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '2.35:1',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '2.39:1',
            'status' => 1,
            'order' => 1
        ]);

        $property = Property::create([
            'name' => '视点',
            'parent_id' => 0,
            'status' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '主观',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '带物主观',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '物体主观',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '旁视',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '直视摄像机',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '打破第四面墙',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '窥视',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '暗中偷窥',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '遮罩-镶边',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '筛滤',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '映像',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '插件视点',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '影子',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '剪影',
            'status' => 1,
            'order' => 1
        ]);
        PropertyValue::create([
            'property_id' => $property->id,
            'name' => '随动',
            'status' => 1,
            'order' => 1
        ]);
    }
}
