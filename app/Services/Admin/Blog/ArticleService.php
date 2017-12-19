<?php
namespace App\Services\Admin\Blog;

use Exception;

use Facades\ {
	App\Repositories\Eloquent\ArticleRepository
};

use App\Repositories\Criteria\FilterSearchCriteriaCriteria;

class ArticleService {

	public function index()
	{
		$name = request('name', '');
		if ($name) {
			ArticleRepository::pushCriteria(new FilterSearchCriteriaCriteria([['name', 'like', "%{$name}%"]]));
		}
		return ArticleRepository::orderBy('id', 'desc')->paginate();
	}
}