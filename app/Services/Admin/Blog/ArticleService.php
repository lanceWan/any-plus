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
			ArticleRepository::pushCriteria(new FilterSearchCriteriaCriteria([['title', 'like', "%{$name}%"]]));
		}
		return ArticleRepository::scopeQuery(function ($query)
		{
			return $query->where('status', '<', config('admin.global.status.trash'));
		})->orderBy('id', 'desc')->paginate();
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

	public function store($request)
	{
		try {
			$article = $this->syncArticle($request);
			flash_info($article,config('admin.global.info.create_success'), config('admin.global.info.create_error'));
		} catch (Exception $e) {
			dd($e);
			flash(config('admin.global.info.create_error'), 'danger');
		}
	}

	public function createCategory()
	{
		try {
			return CategoryRepository::findWhere(['pid' => 0], ['id', 'name'])->toArray();
		} catch (Exception $e) {
			return null;
		}
	}

	public function edit($id)
	{
		try {
			$article = ArticleRepository::with(['tag', 'category'])->find(decodeId($id));
			$categories = CategoryRepository::all(['id', 'name'])->toArray();
			$tags = TagRepository::all(['id', 'name'])->toArray();
			return compact('article', 'categories', 'tags');
		} catch (Exception $e) {
			flash(config('admin.global.info.find_error'), 'danger');
		}
	}

	public function update($request, $id)
	{
		try {
			$article = $this->syncArticle($request, $id);
			flash_info($article,config('admin.global.info.edit_success'),config('admin.global.info.edit_error'));
		} catch (Exception $e) {
			flash(config('admin.global.info.edit_error'), 'danger');
		}
	}

	public function syncArticle($request, $id = '')
	{
		$attributes = $request->all();
		// 文章banner上传
		if ($attributes['edit_banner']) {
			$attributes['banner'] = $attributes['edit_banner'];
		}

		if ($request->hasFile('banner') && empty($attributes['edit_banner'])) {
			$attributes['banner'] = env('UPYUN_DOMAIN').'/'. $request->file('banner')->store('blog', 'upyun');
		}

		$attributes['lead'] = lead($attributes['editor-html-code'], 300);
		$attributes['content_html'] = $attributes['editor-html-code'];
		if ($id) {
			$article = ArticleRepository::update($attributes, decodeId($id));
		}else{
			$article = ArticleRepository::create($attributes);
		}

		if ($article) {
			// 添加标签关系
			$tags = isset($attributes['tags']) ? $attributes['tags'] : [];
			$article->tag()->sync($tags);
			
			// 添加分类关系
			$categories = isset($attributes['category_id']) ? $attributes['category_id'] : [];
			$article->category()->sync($categories);
		}
		return $article;
	}


	public function destroy($id)
	{
		try {
			$result = ArticleRepository::update(['status' => config('admin.global.status.trash')] ,decodeId($id));
			flash_info($result,config('admin.global.info.destroy_success'),config('admin.global.info.destroy_error'));
		} catch (Exception $e) {
			flash(config('admin.global.info.destroy_error'), 'danger');
		}
	}
}