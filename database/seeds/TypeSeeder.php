<?php

use Illuminate\Database\Seeder;
use App\Types;

class TypeSeeder extends Seeder {

    public function run(){
        DB::table('types')->insert(array(
            array('id'=>1, 'type_name'=>"移动互联网"),
            array('id'=>2, 'type_name'=>"在线教育"),
            array('id'=>3, 'type_name'=>"互联网金融"),
            array('id'=>4, 'type_name'=>"汽车交通"),
            array('id'=>5, 'type_name'=>"房产服务"),
            array('id'=>6, 'type_name'=>"旅游信息"),
            array('id'=>7, 'type_name'=>"本地生活"),
            array('id'=>8, 'type_name'=>"游戏竞技"),
            array('id'=>9, 'type_name'=>"广告营销"),
            array('id'=>10, 'type_name'=>"智能硬件"),
            array('id'=>11, 'type_name'=>"医疗健康"),
            array('id'=>12, 'type_name'=>"电子商务"),
            array('id'=>13, 'type_name'=>"工具软件"),
            array('id'=>14, 'type_name'=>"文化娱乐体育"),
            array('id'=>15, 'type_name'=>"企业服务"),
            array('id'=>16, 'type_name'=>"SNS社交网络"),
            array('id'=>17, 'type_name'=>"O2O"),
            array('id'=>18, 'type_name'=>"新媒体"),
            array('id'=>19, 'type_name'=>"可穿戴/软硬结合"),
            array('id'=>20, 'type_name'=>"旅游"),
            array('id'=>21, 'type_name'=>"大数据"),

        ));
    }

}