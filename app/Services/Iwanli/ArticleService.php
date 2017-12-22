<?php
namespace App\Services\Iwanli;

use Exception;

use Facades\ {
	App\Repositories\Eloquent\TagRepository,
	App\Repositories\Eloquent\ArticleRepository,
	App\Repositories\Eloquent\CategoryRepository
};

class ArticleService {
	
	public function index()
	{
		try {
			return ArticleRepository::with('category')->orderBy('id', 'desc')->scopeQuery(function ($query)
			{
				return $query->where(['status' => config('admin.global.status.active')]);
			})->paginate(6, ['id', 'title', 'banner', 'lead', 'view', 'created_at']);
		} catch (Exception $e) {
			return collect([]);
		}
	}

	public function show($id)
	{
		try {
			return ArticleRepository::with('category', 'tag')->find(decodeId($id));
		} catch (Exception $e) {
			abort(500, '文章丢失在火星');
		}
	}

	public function categoryArticle($id)
	{
		try {

			$category = CategoryRepository::find(decodeId($id));
			$articles = $category->article()->where('status', config('admin.global.status.active'))->orderBy('id', 'desc')->paginate();
			return compact('category', 'articles');
		} catch (Exception $e) {
			abort(500, '数据丢失在火星');
		}
	}

	public function tagArticle($id)
	{
		try {
			$tag = TagRepository::find(decodeId($id));
			$articles = $tag->article()->where('status', config('admin.global.status.active'))->orderBy('id', 'desc')->paginate();
			return compact('tag', 'articles');
		} catch (Exception $e) {
			abort(500, '数据丢失在火星');
		}
	}

}