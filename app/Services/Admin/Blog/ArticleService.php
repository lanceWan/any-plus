<?php
namespace App\Services\Admin\Blog;

use Exception;

use Facades\ {
	App\Repositories\Eloquent\TagRepository,
	App\Repositories\Eloquent\ArticleRepository,
	App\Repositories\Eloquent\CategoryRepository
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


	public function create()
	{
		try {
			$categories = CategoryRepository::all(['id', 'name'])->toArray();
			$tags = TagRepository::all(['id', 'name'])->toArray();
			return compact('categories','tags');
		} catch (Exception $e) {
			return null;
		}
	}
}