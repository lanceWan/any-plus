<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;

use Facades\ {
	App\Repositories\Eloquent\LinkRepository
};

class FriendshipLinkComposer
{
    
    public function compose(View $view)
    {
        $key = config('admin.global.cache.link');
        if (cache()->has($key)) {
			$links = cache()->get($key);
		}else{
			$links = LinkRepository::all(['name', 'url']);
			cache()->forever($key,$links);
		}
		$view->with('links',$links);
    }
}