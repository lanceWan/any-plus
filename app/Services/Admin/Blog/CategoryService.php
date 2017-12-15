<?php
namespace App\Services\Admin\Blog;

use Facades\ {
	App\Repositories\Eloquent\MenuRepository,
	App\Repositories\Eloquent\CategoryRepository,
    App\Repositories\Eloquent\PermissionRepository
};

class CategoryService {

	public function getCategoryList()
	{
		// 判断数据是否缓存
		if (cache()->has(config('admin.global.cache.categoryList'))) {
			return cache()->get(config('admin.global.cache.categoryList'));
		}
		return $this->sortCategorySetCache();
	}

	/**
	 * 递归菜单数据
	 * @Author   晚黎
	 * @DateTime 2017-07-31T21:42:01+0800
	 * @param    [type]                   $menus [description]
	 * @param    integer                  $pid   [description]
	 * @return   [type]                          [description]
	 */
	private function sortCategory($categories,$pid=0)
	{
		$arr = [];
		if (empty($categories)) {
			return '';
		}
		foreach ($categories as $key => $v) {
			if ($v['pid'] == $pid) {
				$arr[$key] = $v;
				$arr[$key]['child'] = self::sortCategory($categories,$v['id']);
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
	private function sortCategorySetCache()
	{
		$categories = CategoryRepository::orderBy('sort', 'desc')->all();
		if ($categories->isNotEmpty()) {
			$categoryList = $this->sortCategory($categories->toArray());
			foreach ($categoryList as $key => &$v) {
				if ($v['child']) {
					$sort = array_column($v['child'], 'sort');
					array_multisort($sort,SORT_DESC,$v['child']);
				}
			}
			// 缓存菜单数据
			cache()->forever(config('admin.global.cache.categoryList'),$categoryList);
			return $categoryList;
			
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
		$categories = $this->getCategoryList();
		return compact('categories');
	}

	public function store($attributes)
	{
		try {
			$result = CategoryRepository::create($attributes);
			if ($result) {
				// 更新缓存
				$this->sortCategorySetCache();
			}
			return [
				'status' => $result,
				'message' => $result ? config('admin.global.info.create_success'):config('admin.global.info.create_error'),
			];
		} catch (Exception $e) {
			return [
				'status' => false,
				'message' => config('admin.global.info.create_error'),
			];
		}
	}

	public function show($id)
	{
		try {
			$categories = $this->getCategoryList();
			$category = CategoryRepository::find(decodeId($id));
			return compact('categories', 'category');
		} catch (Exception $e) {
			return null;
		}
	}

	public function edit($id)
	{
		try {
			return $this->show($id);
		} catch (Exception $e) {
			return null;
		}
	}

	public function update($attributes, $id)
	{
		try {
			$isUpdate = CategoryRepository::update($attributes, decodeId($id));
			if ($isUpdate) {
				// 更新缓存
				$this->sortCategorySetCache();
			}
			return [
				'status' => $isUpdate,
				'message' => $isUpdate ? config('admin.global.info.edit_success'):config('admin.global.info.edit_error'),
			];
		} catch (Exception $e) {
			return [
				'status' => false,
				'message' => config('admin.global.info.edit_error'),
			];
		}
	}


	public function destroy($id)
	{
		try {
			$result = CategoryRepository::delete(decodeId($id));
			if ($result) {
				$this->sortCategorySetCache();
			}
			flash_info($result,config('admin.global.info.destroy_success'),config('admin.global.info.destroy_error'));
		} catch (Exception $e) {
			flash(config('admin.global.info.destroy_error'), 'danger');
		}
	}

	public function cacheClear()
	{
		cache()->forget(config('admin.global.cache.categoryList'));
		flash(config('admin.global.info.cache_clear'), 'success')->important();
	}
	
}