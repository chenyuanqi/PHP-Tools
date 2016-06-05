<?php

$_CFG = [
    //工具根路径
    'root_path'    => 'http://127.0.0.1/tools/',
    //mysql 日志文件路径
    'mysql_log'    => 'E:/program/data/mysql_log.log',
    //mysql 配置
    'mysql_host'   => 'localhost',
    'mysql_user'   => 'root',
    'mysql_pwd'    => '',
    'mysql_port'   => '3306',
    //数据字典配置
    'mysql_db'     => 'mysql',
    'mysql_dbName' => '测试',
    //查找替换规则
    'regex_rule'   => [
        [
            'search'  => 'C:/demo',
            'replace' => ''
        ],
        [
            'search'  => '/',
            'replace' => '\\'
        ]
    ],
    //笔记配置
    'note'         => [
        'title'        => '我的笔记 @vikey',
        'add_category' => '新增分类',
        'add_note'     => '新增笔记'
    ]
];
