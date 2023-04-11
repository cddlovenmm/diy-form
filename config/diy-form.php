<?php

return [

    //上传图片路由地址 diy-form/upload
    'upload_api' => '', 

    //图片地址 https://img.yonyou.com/yongyou_ys
    'img_url' => 'https://img.yonyou.com/yongyou_ys',

    /**
     * 固定模板配置
     */
    'solid' => [
        //字段与表单id的对应关系
        'column_by_id' => [
            1 => [
                '姓名', '手机号', '公司名称' 
            ],
            2 => [
                '姓名', '联系电话', '公司', '联系邮箱', '所在部门', '所在行业',
            ],
            3 => [
                '姓名', '手机号', '公司名称', //'邮箱'
            ],
        ],
        //是否添加固定模板
        'is_create' => true,
    ],

    /**
     * 自定义模板配置
     */
    'diy' => [
        // 表单链接前缀 https://y.gkgoo.cn/index?channel=
        'prefix_uri' => 'https://y.gkgoo.cn/index?channel=',
    ],
];