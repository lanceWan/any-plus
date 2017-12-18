<?php

namespace App\Repositories\Eloquent;

use Iwanli\Repository\Eloquent\BaseRepository;
use App\Models\Link;

/**
 * Class Link
 * @package namespace App\Repositories\Eloquent;
 */
class LinkRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Link::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        
    }
}
