<?php
namespace App\Repositories\Presenters\Admin\Blog;

use App\Repositories\Traits\ActionButtonTraitTrait;

class ArticlePresenter {
	
	use ActionButtonTraitTrait;

	protected $module = 'article';

	/**
	 * 文章分类
	 * @author 晚黎
	 * @date   2017-12-19
	 * @param  [type]     $categories        [description]
	 * @param  array      $articleCagegories [description]
	 * @return [type]                        [description]
	 */
	public function categoryList($categories,$articleCagegories=[])
	{
		$html = '';
		if ($categories) {
			foreach ($categories as $v) {
				$html .= <<<Eof
				<option value="{$v['id']}" {$this->checkSelected($v['id'],$articleCagegories,'category_id')}>{$v['name']}</option>
Eof;
			}
		}
		return $html;
	}

	private function checkSelected($id,$lists,$name)
	{
		$name = old($name);
		if ($name) {
			return in_array($id,$name) ? 'selected="selected"':'';
		}
		if ($lists) {
			$lists = array_column($lists, 'id');
			if ($name) {
				if (in_array($id,$lists) && in_array($id,$name)) {
					return 'selected="selected"';
				}
			}else{
				return in_array($id,$lists) ? 'selected="selected"':'';
			}
			return '';
		}
		return '';
	}
	
	/**
	 * 文章标签
	 * @author 晚黎
	 * @date   2017-12-19
	 * @param  [type]     $tags        [description]
	 * @param  array      $articleTags [description]
	 * @return [type]                  [description]
	 */
	public function tagList($tags,$articleTags=[])
	{
		$html = '';
		if ($tags) {
			foreach ($tags as $v) {
				$html .= <<<Eof
				<option value="{$v['id']}" {$this->checkSelected($v['id'],$articleTags,'tags')}>{$v['name']}</option>
Eof;
			}
		}
		return $html;
	}
}