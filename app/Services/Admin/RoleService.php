<?php
namespace App\Services\Admin;

use Facades\ {
	App\Repositories\Eloquent\RoleRepository,
	App\Repositories\Eloquent\PermissionRepository
};

use App\Repositories\Criteria\FilterSearchCriteriaCriteria;

use Exception;

class RoleService {

	public function index()
	{
		$name = request('name', '');
		if ($name) {
			RoleRepository::pushCriteria(new FilterSearchCriteriaCriteria([['name', 'like', "%{$name}%"]]));
		}
		return RoleRepository::orderBy('id', 'desc')->paginate();
	}

	public function create()
	{
		return PermissionRepository::getAllPermissions();
	}

	public function store($attributes)
	{
		try {
			$result = RoleRepository::create($attributes);
			if ($result && isset($attributes['permission']) && $attributes['permission']) {
				// 更新角色权限关系
                $result->permissions()->sync($attributes['permission']);
			}
			flash_info($result,config('admin.global.info.create_success'), config('admin.global.info.create_error'));
		} catch (Exception $e) {
			flash(config('admin.global.info.create_error'), 'danger');
		}
	}

	public function show($id)
	{
		try {
			return RoleRepository::with('permissions')->find(decodeId($id));
		} catch (Exception $e) {
			return null;
		}
	}

	public function edit($id)
	{
		try {
			$role = RoleRepository::with('permissions')->find(decodeId($id));
			$permissions = PermissionRepository::getAllPermissions();
			return compact('role', 'permissions');
		} catch (Exception $e) {
			flash(config('admin.global.info.find_error'), 'danger');
			return redirect()->route('role.index');
		}
	}

	public function update($attributes, $id)
	{
		try {
			$result = RoleRepository::update($attributes, decodeId($id));
			if ($result) {
				// 更新角色权限关系
				if (isset($attributes['permission'])) {
					$result->permissions()->sync($attributes['permission']);
				}else{
					$result->permissions()->sync([]);
				}
				cacheClear();
			}
			flash_info($result,config('admin.global.info.edit_success'),config('admin.global.info.edit_error'));
		} catch (Exception $e) {
			flash(config('admin.global.info.edit_error'), 'danger');
		}
	}

	public function destroy($id)
	{
		try {
			$result = RoleRepository::delete(decodeId($id));
			cacheClear();
			flash_info($result,config('admin.global.info.destroy_success'),config('admin.global.info.destroy_error'));
		} catch (Exception $e) {
			flash(config('admin.global.info.destroy_error'), 'danger');
		}
	}
	
}