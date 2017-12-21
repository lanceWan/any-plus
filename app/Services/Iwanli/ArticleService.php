<?php
namespace App\Services\Iwanli;

use Exception;

use Facades\ {
	App\Repositories\Eloquent\ArticleRepository
};

class ArticleService {
	
	public function index()
	{
		try {
			return ArticleRepository::with('category')->orderBy('id', 'desc')->scopeQuery(function ($query)
			{
				return $query->where(['status' => config('admin.global.status.active')]);
			})->paginate(15, ['id', 'title', 'banner', 'lead', 'view', 'created_at']);
		} catch (Exception $e) {
			return collect([]);
		}
	}

}