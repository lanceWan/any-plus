<?php
namespace App\Services\Admin\Blog;

use Exception;

use Facades\ {
	App\Repositories\Eloquent\TagRepository
};

use App\Repositories\Criteria\FilterSearchCriteriaCriteria;

class TagService {
	
	public function index()
	{
		$name = request('name', '');
		if ($name) {
			TagRepository::pushCriteria(new FilterSearchCriteriaCriteria([['name', 'like', "%{$name}%"]]));
		}
		return TagRepository::orderBy('id', 'desc')->paginate();
	}

	public function store($attributes)
	{
		try {
			$result = TagRepository::create($attributes);
			flash_info($result,config('admin.global.info.create_success'), config('admin.global.info.create_error'));
		} catch (Exception $e) {
			flash(config('admin.global.info.create_error'), 'danger');
		}
	}

	public function edit($id)
	{
		try {
			$permission = TagRepository::find(decodeId($id));
			return compact('permission');
		} catch (Exception $e) {
			flash(config('admin.global.info.find_error'), 'danger');
		}
	}

	public function update($attributes, $id)
	{
		try {
			$result = TagRepository::update($attributes, decodeId($id));
			flash_info($result,config('admin.global.info.edit_success'),config('admin.global.info.edit_error'));
		} catch (Exception $e) {
			flash(config('admin.global.info.edit_error'), 'danger');
		}
	}

	public function destroy($id)
	{
		try {
			$result = TagRepository::delete(decodeId($id));
			flash_info($result,config('admin.global.info.destroy_success'),config('admin.global.info.destroy_error'));
		} catch (Exception $e) {
			flash(config('admin.global.info.destroy_error'), 'danger');
		}
	}
	
}