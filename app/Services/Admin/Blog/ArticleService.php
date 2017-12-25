<?php
namespace App\Services\Admin\Blog;

use PRedis;
use Exception;

use Facades\ {
	App\Repositories\Eloquent\TagRepository,
	App\Repositories\Eloquent\ArticleRepository,
	App\Repositories\Eloquent\CategoryRepository,
	App\Repositories\Eloquent\RecommandRepository
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
			return $query->where('status', '<', config('iwanli.global.status.trash'));
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
			flash_info($article,config('iwanli.global.info.create_success'), config('iwanli.global.info.create_error'));
		} catch (Exception $e) {
			flash(config('iwanli.global.info.create_error'), 'danger');
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
			flash(config('iwanli.global.info.find_error'), 'danger');
		}
	}

	public function update($request, $id)
	{
		try {
			$article = $this->syncArticle($request, $id);
			flash_info($article,config('iwanli.global.info.edit_success'),config('iwanli.global.info.edit_error'));
		} catch (Exception $e) {
			flash(config('iwanli.global.info.edit_error'), 'danger');
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
			// 更新文章到推荐表
			if ($article && env('CACHE_DRIVER', 'file') == 'file') {
				RecommandRepository::updateOrCreate([
					'article_id' => $article->id,
					'push_at' => $article->created_at->toDateTimeString(),
					'score' => $article->created_at->timestamp,
				],[
					'title' => $article->title,
				]);
			}else{
				PRedis::zadd(config('iwanli.global.redis.zset'), $article->created_at->timestamp, collect([
					'article_id' => $article->id,
					'title' => $article->title,
					'push_at' => $article->created_at->toDateTimeString(),
				]));
			}
		}else{
			$article = ArticleRepository::create($attributes);
			// 添加文章到推荐表
			if ($article && env('CACHE_DRIVER', 'file') == 'file') {
				RecommandRepository::create([
					'article_id' => $article->id,
					'title' => $article->title,
					'push_at' => $article->created_at->toDateTimeString(),
					'score' => $article->created_at->timestamp,
				]);
			}else{
				PRedis::zadd(config('iwanli.global.redis.zset'), $article->created_at->timestamp, collect([
					'article_id' => $article->id,
					'title' => $article->title,
					'push_at' => $article->created_at->toDateTimeString(),
				]));
			}
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
			$id = decodeId($id);

			$result = ArticleRepository::update(['status' => config('iwanli.global.status.trash')] ,$id);
			RecommandRepository::deleteWhere([
				'article_id' => $id
			]);
			
			flash_info($result,config('iwanli.global.info.destroy_success'),config('iwanli.global.info.destroy_error'));
		} catch (Exception $e) {
			flash(config('iwanli.global.info.destroy_error'), 'danger');
		}
	}
}