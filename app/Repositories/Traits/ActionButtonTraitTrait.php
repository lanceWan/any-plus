<?php
namespace App\Repositories\Traits;


trait ActionButtonTraitTrait {

	/**
	 * 修改按钮
	 * @author 晚黎
	 * @date   2017-12-12
	 * @param  [type]     $id [description]
	 * @return [type]         [description]
	 */
	private function getEditActionButton($id)
	{
		if (haspermission($this->module.'controller.edit')) {
			$url = route($this->module.'.edit', [encodeId($id, $this->module)]);
			return <<<Eof
				<a href="{$url}" class="btn btn-xs btn-outline btn-warning tooltips" data-original-title="编辑" data-placement="top">
					<i class="fa fa-edit"></i>
				</a>
Eof;
		}
		return '';
	}

	/**
	 * 删除按钮
	 * @author 晚黎
	 * @date   2017-12-12
	 * @param  [type]     $id [description]
	 * @return [type]         [description]
	 */
	private function getDestroyActionButton($id)
	{
		if (haspermission($this->module.'controller.destroy')) {
			$url = route($this->module.'.destroy', [encodeId($id, $this->module)]);
			$csrfToken = csrf_field();
			$method = method_field('delete');
			return <<<Eof
				<a href="javascript:;" onclick="return false" class="btn btn-xs btn-outline btn-danger tooltips destroy_item" data-original-title="删除"  data-placement="top">
					<i class="fa fa-trash"></i>
					<form action="{$url}" method="POST" style="display:none">
						$csrfToken
						$method
					</form>
				</a>
Eof;
		}
		return '';
	}

	/**
	 * 模态框查看按钮
	 * @author 晚黎
	 * @date   2017-12-12
	 * @param  [type]     $id [description]
	 * @return [type]         [description]
	 */
	private function getModalShowActionButtion($id)
	{
		if (haspermission($this->module.'controller.show')) {
			return '<a href="'.route($this->module.'.show', [encodeId($id, $this->module)]).'" class="btn btn-xs btn-info tooltips" data-toggle="modal" data-target="#myModal" data-original-title="查看"  data-placement="top"><i class="fa fa-eye"></i></a> ';
		}
		return '';
	}

	/**
	 * 超链接查看按钮
	 * @author 晚黎
	 * @date   2017-12-12
	 * @param  [type]     $id [description]
	 * @return [type]         [description]
	 */
	private function getShowActionButtion($id)
	{
		if (haspermission($this->module.'controller.show')) {
			return '<a href="'.route($this->module.'.show', [encodeId($id, $this->module)]).'" class="btn btn-xs btn-info tooltips" data-original-title="查看"  data-placement="top"><i class="fa fa-eye"></i></a> ';
		}
		return '';
	}

	/**
	 * 默认显示编辑和删除，如果需要查看进行重写
	 * @author 晚黎
	 * @date   2017-12-12
	 * @param  [type]     $id [description]
	 * @return [type]         [description]
	 */
	public function getActionButtonAttribute($id)
	{
		return $this->getEditActionButton($id)
				.$this->getDestroyActionButton($id);
	}

	/**
	 * 分页显示信息
	 * @author 晚黎
	 * @date   2017-12-19
	 * @param  [type]     $paginate [description]
	 * @return [type]               [description]
	 */
	public function paginationInfo($paginate)
	{
        if ($paginate->total()) {
        	$first = ($paginate->currentPage() - 1) * $paginate->perPage();
        	$end = $paginate->total() > $paginate->perPage() ?  $paginate->currentPage() * $paginate->perPage() : $paginate->total();
        	return <<<Eof
			<div class="col-sm-4 m-t-md text-left">
				显示第 {$first} 至 {$end} 项结果，共 {$paginate->total()} 项
			</div>
Eof;
        }
	}
    
}