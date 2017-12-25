<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Repositories\Traits\RecommandTrait;

class RecommendedArticlesComposer
{
    use RecommandTrait;

    public function compose(View $view)
    {
        $recommendedArticles = $this->getRecommandList();
		$view->with('recommendedArticles',$recommendedArticles);
    }
}