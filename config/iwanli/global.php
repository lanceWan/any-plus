<?php
return [
	// 自定义用户名
	'username' => 'username',
	// 默认主题
	'theme' => 'inspinia',
	'cache' => [
		'menuList' => 'menuList',
		'categoryList' => 'categoryList',
		'link' => 'friendship',
	],
	'redis' => [
		'zset' => 'iwanli:trending_articles'
	],
	'encrypt' => true,
	'info' => [
		'create_success' => '创建成功',
		'create_error' => '创建失败',
		'find_error' => '获取数据失败',
		'edit_success' => '编辑成功',
		'edit_error' => '编辑失败',
		'destroy_success' => '删除成功',
		'destroy_error' => '删除失败',
		'cache_clear' => '清除缓存成功！',
	],
	'status' => [
		'active' => 1,
		'trash' => 99,
	]
];