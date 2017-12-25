<?php

namespace App\Repositories\Eloquent;

use Iwanli\Repository\Eloquent\BaseRepository;
use App\Models\Recommand;

/**
 * Class Recommand
 * @package namespace App\Repositories\Eloquent;
 */
class RecommandRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Recommand::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        
    }
}
