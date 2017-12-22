<?php
namespace App\Services\Admin\Blog;

use Exception;

use Facades\ {
	App\Repositories\Eloquent\LinkRepository
};

use App\Repositories\Criteria\FilterSearchCriteriaCriteria;

class LinkService {
	
	public function index()
	{
		$name = request('name', '');
		if ($name) {
			LinkRepository::pushCriteria(new FilterSearchCriteriaCriteria([['name', 'like', "%{$name}%"]]));
		}
		return LinkRepository::orderBy('id', 'desc')->paginate();
	}

	public function store($attributes)
	{
		try {
			$result = LinkRepository::create($attributes);
			cache()->forget(config('admin.global.cache.link'));
			flash_info($result,config('admin.global.info.create_success'), config('admin.global.info.create_error'));
		} catch (Exception $e) {
			flash(config('admin.global.info.create_error'), 'danger');
		}
	}

	public function edit($id)
	{
		try {
			$link = LinkRepository::find(decodeId($id));
			return compact('link');
		} catch (Exception $e) {
			flash(config('admin.global.info.find_error'), 'danger');
		}
	}

	public function update($attributes, $id)
	{
		try {
			$result = LinkRepository::update($attributes, decodeId($id));
			cache()->forget(config('admin.global.cache.link'));
			flash_info($result,config('admin.global.info.edit_success'),config('admin.global.info.edit_error'));
		} catch (Exception $e) {
			flash(config('admin.global.info.edit_error'), 'danger');
		}
	}

	public function destroy($id)
	{
		try {
			$result = LinkRepository::delete(decodeId($id));
			cache()->forget(config('admin.global.cache.link'));
			flash_info($result,config('admin.global.info.destroy_success'),config('admin.global.info.destroy_error'));
		} catch (Exception $e) {
			flash(config('admin.global.info.destroy_error'), 'danger');
		}
	}
	
}