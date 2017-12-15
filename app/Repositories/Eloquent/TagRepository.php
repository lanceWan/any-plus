<?php

namespace App\Repositories\Eloquent;

use Iwanli\Repository\Eloquent\BaseRepository;
use App\Models\Tag;

/**
 * Class Tag
 * @package namespace App\Repositories\Eloquent;
 */
class TagRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tag::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        
    }
}
