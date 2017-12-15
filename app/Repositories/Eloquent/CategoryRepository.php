<?php

namespace App\Repositories\Eloquent;

use Iwanli\Repository\Eloquent\BaseRepository;
use App\Models\Category;

/**
 * Class Category
 * @package namespace App\Repositories\Eloquent;
 */
class CategoryRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        
    }
}
