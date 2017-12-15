<?php
namespace App\Services\Admin;

use Facades\ {
	App\Repositories\Eloquent\UserRepository,
	App\Repositories\Eloquent\RoleRepository,
	App\Repositories\Eloquent\PermissionRepository
};

use App\Repositories\Criteria\FilterSearchCriteriaCriteria;

use Exception;

class UserService {

	public function index()
	{
		$name = request('name', '');
		if ($name) {
			UserRepository::pushCriteria(new FilterSearchCriteriaCriteria([['name', 'like', "%{$name}%"]]));
		}
		return UserRepository::orderBy('id', 'desc')->paginate();
	}


	public function create()
	{
		$permissions = PermissionRepository::getAllPermissions();
		$roles = RoleRepository::getAllRole();
		return compact('permissions', 'roles');
	}

	public function store($attributes)
	{
		try {
			$attributes['password'] = bcrypt($attributes['password']);
			$result = UserRepository::create($attributes);
			if ($result) {
				// 角色与用户关系
				if (isset($attributes['role']) && $attributes['role']) {
					$result->roles()->sync($attributes['role']);
				}
				// 权限与用户关系
				if (isset($attributes['permission']) && $attributes['permission']) {
					$result->userPermissions()->sync($attributes['permission']);
				}
				cacheClear();
			}
			flash_info($result,config('admin.global.info.create_success'), config('admin.global.info.create_error'));
		} catch (Exception $e) {
			flash(config('admin.global.info.create_error'), 'danger');
		}
	}

	public function show($id)
	{
		try {
			$user = UserRepository::with(['userPermissions', 'roles'])->find(decodeId($id));
			$permissions = PermissionRepository::getAllPermissions();
			$roles = RoleRepository::getAllRole();
			return compact('user', 'permissions', 'roles');
		} catch (Exception $e) {
			return null;
		}
	}

	public function edit($id)
	{
		return $this->show($id);
	}


	public function update($attributes, $id)
	{
		try {
			// 修改密码
			if ($attributes['password']) {
				$attributes['password'] = bcrypt($attributes['password']);
			}else{
				unset($attributes['password']);
			}
			$result = UserRepository::update($attributes, decodeId($id));
			if ($result) {
				// 更新用户角色关系
				if (isset($attributes['role']) && $attributes['role']) {
					$result->roles()->sync($attributes['role']);
				}else{
					$result->roles()->sync([]);
				}
				// 更新用户权限关系
				if (isset($attributes['permission']) && $attributes['permission']) {
					$result->userPermissions()->sync($attributes['permission']);
				}else{
					$result->userPermissions()->sync([]);
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
			$result = UserRepository::delete(decodeId($id));
			cacheClear();
			flash_info($result,config('admin.global.info.destroy_success'),config('admin.global.info.destroy_error'));
		} catch (Exception $e) {
			flash(config('admin.global.info.destroy_error'), 'danger');
		}
	}

}