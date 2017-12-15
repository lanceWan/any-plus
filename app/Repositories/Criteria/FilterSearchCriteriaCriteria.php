<?php

namespace App\Repositories\Criteria;

use Iwanli\Repository\Contracts\CriteriaInterface;
use Iwanli\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterSearchCriteriaCriteria
 * @package App\Repositories\Criteria
 */
class FilterSearchCriteriaCriteria implements CriteriaInterface
{
    private $searchable;
    /**
     * [__construct description]
     */
    public function __construct($searchable)
    {
        $this->searchable = $searchable;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where($this->searchable);
    }
}