<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
class BlogPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //////////
        //博客管理//
        //////////
        Permission::create([
            'name' => '博客管理',
            'slug' => 'system.blog',
            'description' => '博客管理'
        ]);
        /**
         * 文章列表
         */
        Permission::create([
            'name' => '文章列表',
            'slug' => 'articlecontroller.index',
            'description' => '文章列表'
        ]);
        /**
         * 创建文章
         */
        Permission::create([
            'name' => '创建文章',
            'slug' => 'articlecontroller.create',
            'description' => '创建文章'
        ]);
        /**
         * 修改文章
         */
        Permission::create([
            'name' => '修改文章',
            'slug' => 'articlecontroller.update',
            'description' => '修改文章'
        ]);
        /**
         * 创建文章
         */
        Permission::create([
            'name' => '创建文章',
            'slug' => 'articlecontroller.store',
            'description' => '创建文章'
        ]);
        /**
         * 删除文章
         */
        Permission::create([
            'name' => '删除文章',
            'slug' => 'articlecontroller.destroy',
            'description' => '删除文章'
        ]);
        /**
         * 修改文章
         */
        Permission::create([
            'name' => '修改文章',
            'slug' => 'articlecontroller.edit',
            'description' => '修改文章'
        ]);

        /**
         * 查看文章
         */
        Permission::create([
            'name' => '查看文章',
            'slug' => 'articlecontroller.show',
            'description' => '查看文章'
        ]);


        /**
         * 分类列表
         */
        Permission::create([
            'name' => '分类列表',
            'slug' => 'categorycontroller.index',
            'description' => '分类列表'
        ]);
        /**
         * 创建分类
         */
        Permission::create([
            'name' => '创建分类',
            'slug' => 'categorycontroller.create',
            'description' => '创建分类'
        ]);
        /**
         * 创建分类
         */
        Permission::create([
            'name' => '创建分类',
            'slug' => 'categorycontroller.store',
            'description' => '创建分类'
        ]);
        /**
         * 删除分类
         */
        Permission::create([
            'name' => '删除分类',
            'slug' => 'categorycontroller.destroy',
            'description' => '删除分类'
        ]);

        /**
         * 修改分类
         */
        Permission::create([
            'name' => '修改分类',
            'slug' => 'categorycontroller.edit',
            'description' => '修改分类'
        ]);
        /**
         * 修改分类
         */
        Permission::create([
            'name' => '修改分类',
            'slug' => 'categorycontroller.update',
            'description' => '修改分类'
        ]);

        /**
         * 查看分类
         */
        Permission::create([
            'name' => '查看分类',
            'slug' => 'categorycontroller.show',
            'description' => '查看分类'
        ]);


        /**
         * 标签列表
         */
        Permission::create([
            'name' => '标签列表',
            'slug' => 'tagcontroller.index',
            'description' => '标签列表'
        ]);
        /**
         * 创建标签
         */
        Permission::create([
            'name' => '创建标签',
            'slug' => 'tagcontroller.create',
            'description' => '创建标签'
        ]);
        /**
         * 创建标签
         */
        Permission::create([
            'name' => '创建标签',
            'slug' => 'tagcontroller.store',
            'description' => '创建标签'
        ]);
        /**
         * 删除标签
         */
        Permission::create([
            'name' => '删除标签',
            'slug' => 'tagcontroller.destroy',
            'description' => '删除标签'
        ]);
        
        /**
         * 修改标签
         */
        Permission::create([
            'name' => '修改标签',
            'slug' => 'tagcontroller.edit',
            'description' => '修改标签'
        ]);
        /**
         * 修改标签
         */
        Permission::create([
            'name' => '修改标签',
            'slug' => 'tagcontroller.update',
            'description' => '修改标签'
        ]);

        /**
         * 友情链接
         */
        Permission::create([
            'name' => '友情链接列表',
            'slug' => 'linkcontroller.index',
            'description' => '友情链接列表'
        ]);
        /**
         * 添加友情链接
         */
        Permission::create([
            'name' => '添加友情链接',
            'slug' => 'linkcontroller.create',
            'description' => '添加友情链接'
        ]);
        /**
         * 添加友情链接
         */
        Permission::create([
            'name' => '添加友情链接',
            'slug' => 'linkcontroller.store',
            'description' => '添加友情链接'
        ]);
        /**
         * 删除友情链接
         */
        Permission::create([
            'name' => '删除友情链接',
            'slug' => 'linkcontroller.destroy',
            'description' => '删除友情链接'
        ]);
        
        /**
         * 修改友情链接
         */
        Permission::create([
            'name' => '修改友情链接',
            'slug' => 'linkcontroller.edit',
            'description' => '修改友情链接'
        ]);

        /**
         * 修改友情链接
         */
        Permission::create([
            'name' => '修改友情链接',
            'slug' => 'linkcontroller.update',
            'description' => '修改友情链接'
        ]);
        
    }
}
