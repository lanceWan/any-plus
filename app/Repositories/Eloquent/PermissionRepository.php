<?php

namespace App\Repositories\Eloquent;

use Iwanli\Repository\Eloquent\BaseRepository;
use App\Models\Permission;

/**
 * Class Permission
 * @package namespace App\Repositories\Eloquent;
 */
class PermissionRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        
    }

    public function getAllPermissions()
    {
        $array = [];
        $permissions = $this->model->all(['id', 'name', 'slug']);
        if ($permissions->isNotEmpty()) {
            foreach ($permissions as $v) {
                $temp = explode('.', $v->slug);
                $array[$temp[0]][] = $v->toArray();
            }
        }
        return $array;
    }
}
