<?php
namespace App\Services\Admin\System;

use Exception;

use Facades\ {
	App\Repositories\Eloquent\PermissionRepository
};

use App\Repositories\Criteria\FilterSearchCriteriaCriteria;

class PermissionService {

	public function index()
	{
		$name = request('name', '');
		if ($name) {
			PermissionRepository::pushCriteria(new FilterSearchCriteriaCriteria([['name', 'like', "%{$name}%"]]));
		}
		return PermissionRepository::orderBy('id', 'desc')->paginate();
	}

	public function store($attributes)
	{
		try {
			$result = PermissionRepository::create($attributes);
			flash_info($result,config('iwanli.global.info.create_success'), config('iwanli.global.info.create_error'));
		} catch (Exception $e) {
			flash(config('iwanli.global.info.create_error'), 'danger');
		}
	}

	public function edit($id)
	{
		try {
			$permission = PermissionRepository::find(decodeId($id));
			return compact('permission');
		} catch (Exception $e) {
			flash(config('iwanli.global.info.find_error'), 'danger');
		}
	}

	public function update($attributes, $id)
	{
		try {
			$result = PermissionRepository::update($attributes, decodeId($id));
			flash_info($result,config('iwanli.global.info.edit_success'),config('iwanli.global.info.edit_error'));
		} catch (Exception $e) {
			flash(config('iwanli.global.info.edit_error'), 'danger');
		}
	}

	public function destroy($id)
	{
		try {
			$result = PermissionRepository::delete(decodeId($id));
			flash_info($result,config('iwanli.global.info.destroy_success'),config('iwanli.global.info.destroy_error'));
		} catch (Exception $e) {
			flash(config('iwanli.global.info.destroy_error'), 'danger');
		}
	}
	
}