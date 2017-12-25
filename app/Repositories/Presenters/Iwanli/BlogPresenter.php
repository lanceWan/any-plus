<?php
namespace App\Repositories\Presenters\Iwanli;

class BlogPresenter {

	/**
	 * 文章列表渲染
	 * @author 晚黎
	 * @date   2017-12-22
	 * @param  [type]     $articles [description]
	 * @return [type]               [description]
	 */
	public function articleList($articles)
	{
		$str = '';
		if ($articles->isNotEmpty()) {
			foreach ($articles as $article) {
				$banner = '';
                $url = url('blog/article/'.encodeId($article->id).'.html');
                $views = $article->view ? $article->view : '(-_-#)';
                if ($article->banner) {
                    $banner .= <<<Eof
                    <div class="starImg">
                        <a href="{$url}"><img class="img-responsive margin-b-10" src="{$article->banner}" alt="{$article->title}"></a>
                    </div>
Eof;
                }
				$str .= <<<Eof
				<div class="col-md-12 grid-item">
                    <article class="blog-grid">
                        <div class="blog-grid-box-shadow">
                            <div class="blog-grid-content">
                                <h2 class="blog-grid-title-md"><a href="{$url}">{$article->title}</a></h2>
                                {$banner}
                                {$article->lead}
                            </div>
                            <div class="blog-grid-supplemental">
                                <span class="blog-grid-supplemental-title">
                                    {$this->articleCategory($article->category)} - <i class="fa fa-clock-o"></i> {$article->created_at}
                                </span>
                                <span class="blog-grid-supplemental-title pull-right">
                                    <i class="fa fa-fire"></i> {$views}
                                </span>
                            </div>
                        </div>
                    </article>
                </div>
Eof;
			}
		}else{
            $str = <<<Eof
            <div class="col-md-12 grid-item">
                    <article class="blog-grid">
                        <div class="blog-grid-box-shadow">
                            <div class="blog-grid-content">
                                暂无文章
                            </div>
                        </div>
                    </article>
                </div>
Eof;
        }
		return $str;
	}

	/**
	 * 文章所属分类
	 * @author 晚黎
	 * @date   2017-12-22
	 * @param  [type]     $category [description]
	 * @return [type]               [description]
	 */
    private function articleCategory($category)
    {
        $str = '<i class="fa fa-leaf"></i>';
        foreach ($category as $v) {
            $str .= '<a class="blog-grid-supplemental-category" href="'.url('category/'.encodeId($v->id).'.html').'"> '.$v->name.'</a>,';
        }
        return rtrim($str,',');
    }

    /**
     * 首页分类导航
     * @author 晚黎
     * @date   2017-12-22
     * @param  [type]     $categories [description]
     * @return [type]                 [description]
     */
    public function categoriesList($categories)
    {
        $str = '';
        if ($categories) {
            foreach ($categories as $category) {
                $icon = $category['icon'] ? '<i class="'.$category['icon'].'"></i> ':'';
                $url = $category['url'] ? $category['url'] : url('category/'.encodeId($category['id']).'.html');
                $target = $category['url'] ? 'target="_blank"':'';
                if ($category['child']) {
                    $str .= <<<Eof
                    <li class="nav-item dropdown">
                        <a class="nav-item-child dropdown-toggle radius-3" href="javascript:void(0);" data-toggle="dropdown">
                            {$icon}{$category['name']}
                        </a>
                        {$this->childCategoryList($category['child'])}
                    </li>
Eof;
                }else{
                    $str .= <<<Eof
                    <li class="nav-item">
                        <a class="nav-item-child radius-3" {$target} href="{$url}">
                            {$icon}{$category['name']}
                        </a>
                    </li>
Eof;
                }
            }
        }
        return $str;
    }

    /**
     * 子分类
     * @author 晚黎
     * @date   2017-12-22
     * @param  [type]     $categories [description]
     * @return [type]                 [description]
     */
    private function childCategoryList($categories)
    {
        $str = '<ul class="dropdown-menu">';
        foreach ($categories as $category) {
            $icon = $category['icon'] ? '<i class="'.$category['icon'].'"></i> ':'';
            $url = $category['url'] ? $category['url'] : url('category/'.encodeId($category['id']).'.html');
            $target = $category['url'] ? 'target="_blank"':'';
            $str .= <<<Eof
            <li class="dropdown-menu-item"><a class="dropdown-menu-item-child" {$target} href="{$url}">{$icon}{$category['name']}</a></li>
Eof;
        }
        return $str .= '</ul>';
    }

    /**
     * 友情链接列表
     * @author 晚黎
     * @date   2017-12-22
     * @param  [type]     $links [description]
     * @return [type]            [description]
     */
    public function linkList($links)
    {
        $str = '';
        if ($links->isNotEmpty()) {
            foreach ($links as $link) {
                $str .= '<li><i class="lists-item-element fa fa-angle-right"></i> <a target="_blank" href="'.$link->url.'">'.$link->name.'</a></li>';    
            }
        }
        return $str;
    }

    /**
     * 文章详情页分类显示
     * @author 晚黎
     * @date   2017-12-22
     * @param  [type]     $categories [description]
     * @return [type]                 [description]
     */
    public function postDetailCategories($categories)
    {
        $str = '';
        foreach ($categories as $category) {
            $str .= '<li><a href="'.url('blog/category/'.encodeId($category->id).'.html').'">'.$category->name.'</a></li>';
        }
        return $str;
    }

    /**
     * 文章标签显示
     * @author 晚黎
     * @date   2017-12-22
     * @param  [type]     $tags [description]
     * @return [type]           [description]
     */
    public function postDetailTags($tags)
    {
        $str = '';
        if ($tags->isNotEmpty()) {
            foreach ($tags as $tag) {
                $str .= '<li><a href="'.url('blog/tag/'.encodeId($tag->id).'.html').'">'.$tag->name.'</a></li>';
            }
        }
        return $str;

    }

    /**
     * 推荐文章
     * @author 晚黎
     * @date   2017-12-25
     * @param  [type]     $recommendedArticles [description]
     * @return [type]                          [description]
     */
    public function recommendedArticleList($recommendedArticles)
    {
        $str = '';
        if ($recommendedArticles) {
            foreach ($recommendedArticles as $article) {
                if (env('CACHE_DRIVER', 'file') == 'redis') {
                    $article = json_decode($article,true);
                }
                $url = url('blog/article/'.encodeId($article['article_id']).'.html');
                $str .= <<<Eof
                <li class="timeline-v2-list-item">
                    <i class="timeline-v2-badge-icon radius-circle fa fa-calendar"></i>
                    <small class="timeline-v2-news-date">{$article['push_at']}</small>
                    <h5 class="timeline-v2-news-title"><a href="{$url}">{$article['title']}</a></h5>
                </li>
Eof;
            }
        }
        return $str;
    }
}