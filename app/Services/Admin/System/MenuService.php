<?php
namespace App\Services\Admin\System;

use Facades\ {
	App\Repositories\Eloquent\MenuRepository,
    App\Repositories\Eloquent\PermissionRepository
};

class MenuService {

	public function getMenuList()
	{
		// 判断数据是否缓存
		if (cache()->has(config('iwanli.global.cache.menuList'))) {
			return cache()->get(config('iwanli.global.cache.menuList'));
		}
		return $this->sortMenuSetCache();
	}

	/**
	 * 递归菜单数据
	 * @Author   晚黎
	 * @DateTime 2017-07-31T21:42:01+0800
	 * @param    [type]                   $menus [description]
	 * @param    integer                  $pid   [description]
	 * @return   [type]                          [description]
	 */
	private function sortMenu($menus,$pid=0)
	{
		$arr = [];
		if (empty($menus)) {
			return '';
		}
		foreach ($menus as $key => $v) {
			if ($v['pid'] == $pid) {
				$arr[$key] = $v;
				$arr[$key]['child'] = self::sortMenu($menus,$v['id']);
			}
		}
		return $arr;
	}
	
	/**
	 * 排序子菜单并缓存
	 * @author 晚黎
	 * @date   2017-12-13
	 * @return [type]     [description]
	 */
	private function sortMenuSetCache()
	{
		$menus = MenuRepository::orderBy('sort', 'desc')->all();
		if ($menus->isNotEmpty()) {
			$menuList = $this->sortMenu($menus->toArray());
			foreach ($menuList as $key => &$v) {
				if ($v['child']) {
					$sort = array_column($v['child'], 'sort');
					array_multisort($sort,SORT_DESC,$v['child']);
				}
			}
			// 缓存菜单数据
			cache()->forever(config('iwanli.global.cache.menuList'),$menuList);
			return $menuList;
			
		}
		return '';
	}

	/**
	 * 添加菜单视图
	 * @author 晚黎
	 * @date   2017-12-13
	 * @return [type]     [description]
	 */
	public function create()
	{
		$menus = $this->getMenuList();
		$permissions = PermissionRepository::all(['name', 'slug']);
		return compact('menus', 'permissions');
	}

	public function store($attributes)
	{
		try {
			$result = MenuRepository::create($attributes);
			if ($result) {
				// 更新缓存
				$this->sortMenuSetCache();
			}
			return [
				'status' => $result,
				'message' => $result ? config('iwanli.global.info.create_success'):config('iwanli.global.info.create_error'),
			];
		} catch (Exception $e) {
			return [
				'status' => false,
				'message' => config('iwanli.global.info.create_error'),
			];
		}
	}

	public function show($id)
	{
		try {
			$menus = $this->getMenuList();
			$menu = MenuRepository::find(decodeId($id));
			return compact('menus', 'menu');
		} catch (Exception $e) {
			return null;
		}
	}

	public function edit($id)
	{
		try {
			$attr = $this->show($id);
			$permissions = PermissionRepository::all(['name', 'slug']);
			return array_merge($attr, compact('permissions'));
		} catch (Exception $e) {
			return null;
		}
	}

	public function update($attributes, $id)
	{
		try {
			$isUpdate = MenuRepository::update($attributes, decodeId($id));
			if ($isUpdate) {
				// 更新缓存
				$this->sortMenuSetCache();
			}
			return [
				'status' => $isUpdate,
				'message' => $isUpdate ? config('iwanli.global.info.edit_success'):config('iwanli.global.info.edit_error'),
			];
		} catch (Exception $e) {
			return [
				'status' => false,
				'message' => config('iwanli.global.info.edit_error'),
			];
		}
	}


	public function destroy($id)
	{
		try {
			$result = MenuRepository::delete(decodeId($id));
			if ($result) {
				$this->sortMenuSetCache();
			}
			flash_info($result,config('iwanli.global.info.destroy_success'),config('iwanli.global.info.destroy_error'));
		} catch (Exception $e) {
			flash(config('iwanli.global.info.destroy_error'), 'danger');
		}
	}

	public function cacheClear()
	{
		cache()->forget(config('iwanli.global.cache.menuList'));
		flash(config('iwanli.global.info.cache_clear'), 'success')->important();
	}
	
}