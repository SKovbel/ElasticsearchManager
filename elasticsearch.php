<?php
require_once 'Autoload.php';
Autoload::register();

use Curl\CurlRequest;
// 实例化curl请求类
$curl = new CurlRequest();

// 检查集群运行健康状态
$api = '_cat/health?v&pretty';
// echo $curl->get($api);

// 获取集群的节点列表
$api = '_cat/nodes?v&pretty';
echo $curl->get($api);

// 创建索引 - 有问题
$api = 'users?pretty&pretty';
// echo $curl->put($api);

// 列出所有索引
$api = '_cat/indices?v&pretty';
// echo $curl->get($api);

// 索引一个文档 - 有问题
$api = 'customer/external/1?pretty&pretty';
$customerInfo = [
    'name' => '张三'
];
// echo $curl->put($api, $customerInfo);
