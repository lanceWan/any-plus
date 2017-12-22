<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use App\Services\Admin\Blog\CategoryService;
class CategoryComposer
{
    
    protected $service;

    
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    
    public function compose(View $view)
    {
        $view->with('categories', $this->service->getCategoryList());
    }
}