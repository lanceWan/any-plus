<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;
class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
        	'name' => "控制台",
	        'pid' => 0,
	        'icon' => "fa fa-dashboard",
	        'slug' => "homecontroller.index",
	        'url' => "admin",
	        'active' => "admin",
	        'description' => "后台首页",
        ]);


        $system = Menu::create([
        	'name' => "系统管理",
	        'pid' => 0,
	        'icon' => "fa fa-cog",
	        'slug' => "system.manage",
	        'active' => "admin/role*,admin/permission*,admin/user*,admin/menu*",
	        'description' => "系统功能管理",
        ]);

        Menu::create([
        	'name' => "用户管理",
	        'pid' => $system->id,
	        'icon' => "fa fa-users",
	        'slug' => "usercontroller.index",
	        'url' => "admin/user",
	        'active' => "admin/user*",
	        'description' => "显示用户管理",
        ]);

        Menu::create([
        	'name' => "角色管理",
	        'pid' => $system->id,
	        'icon' => "fa fa-male",
	        'slug' => "rolecontroller.index",
	        'url' => "admin/role",
	        'active' => "admin/role*",
	        'description' => "显示角色管理",
        ]);

        Menu::create([
        	'name' => "权限管理",
	        'pid' => $system->id,
	        'icon' => "fa fa-paper-plane",
	        'slug' => "permissioncontroller.index",
	        'url' => "admin/permission",
	        'active' => "admin/permission*",
	        'description' => "显示权限管理",
        ]);

        Menu::create([
        	'name' => "菜单管理",
	        'pid' => $system->id,
	        'icon' => "fa fa-navicon",
	        'slug' => "menucontroller.index",
	        'url' => "admin/menu",
	        'active' => "admin/menu*",
	        'description' => "显示菜单管理",
        ]);

        /**
         * -------------------------------------------------
         * 博客管理
         * -------------------------------------------------
         */
        $blogManager = Menu::create([
            'name' => '博客管理',
            'pid' => 0,
            'icon' => 'fa fa-diamond',
            'slug' => 'system.blog',
            'url' => 'admin/article*,admin/category*,admin/tag*,admin/link*,admin/setting*',
            'active' => 'admin/article*,admin/category*,admin/tag*,admin/link*,admin/setting*',
            'description' => '博客管理',
        ]);

        Menu::create([
            'name' => '文章管理',
            'pid' => $blogManager->id,
            'icon' => 'fa fa-paw',
            'slug' => 'articlecontroller.index',
            'url' => 'admin/article',
            'active' => 'admin/article',
            'description' => '文章管理',
        ]);

        Menu::create([
            'name' => '分类管理',
            'pid' => $blogManager->id,
            'icon' => 'fa fa-list-ul',
            'slug' => 'categorycontroller.index',
            'url' => 'admin/category',
            'active' => 'admin/category*',
            'description' => '分类管理',
        ]);

        Menu::create([
            'name' => '标签管理',
            'pid' => $blogManager->id,
            'icon' => 'fa fa-tags',
            'slug' => 'tagcontroller.index',
            'url' => 'admin/tag',
            'active' => 'admin/tag*',
            'description' => '标签管理',
        ]);

        Menu::create([
            'name' => '友情链接',
            'pid' => $blogManager->id,
            'icon' => 'fa fa-link',
            'slug' => 'linkcontroller.index',
            'url' => 'admin/link',
            'active' => 'admin/link*',
            'description' => '友情链接',
        ]);

        Menu::create([
            'name' => '博客配置',
            'pid' => $blogManager->id,
            'icon' => 'fa fa-cogs',
            'slug' => 'settingcontroller.index',
            'url' => 'admin/setting',
            'active' => 'admin/setting*',
            'description' => '博客配置',
        ]);
    }
}
