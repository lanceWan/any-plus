<?php
namespace App\Repositories\Presenters\Admin\Blog;

class CategoryPresenter
{
	public function menuNestable($menus)
	{
		if ($menus) {
			$item = '';
			foreach ($menus as $v) {
				$item.= $this->getNestableItem($v);
			}
			return $item;
		}
		return '暂无菜单';
	}

	/**
	 * 返回菜单HTML代码
	 * @author 晚黎
	 * @date   2017-12-12
	 * @param  [type]     $menu [description]
	 * @return [type]           [description]
	 */
	protected function getNestableItem($menu)
	{
		$icon = $menu['icon'] ? '<i class="'.$menu['icon'].'"></i>' : '';
		if ($menu['child']) {
			return $this->getHandleList($menu['id'],$menu['name'],$icon,$menu['child']);
		}
		$labelInfo = $menu['pid'] == 0 ?  'label-info':'label-warning';
		return <<<Eof
				<li class="dd-item dd3-item" data-id="{$menu['id']}">
                    <div class="dd-handle dd3-handle"></div>
                    <div class="dd3-content"><span class="label {$labelInfo}">{$icon}</span> {$menu['name']} {$this->getActionButtons($menu['id'])}</div>
                </li>
Eof;
	}
	/**
	 * 判断是否有子集
	 * @author 晚黎
	 * @date   2017-12-12
	 * @param  [type]     $id    [description]
	 * @param  [type]     $name  [description]
	 * @param  [type]     $icon  [description]
	 * @param  [type]     $child [description]
	 * @return [type]            [description]
	 */
	protected function getHandleList($id,$name,$icon,$child)
	{
		$handle = '';
		if ($child) {
			foreach ($child as $v) {
				$handle .= $this->getNestableItem($v);
			}
		}

		$html = <<<Eof
		<li class="dd-item dd3-item" data-id="{$id}">
            <div class="dd-handle dd3-handle"></div>
            <div class="dd3-content">
            	<span class="label label-info">{$icon}</span> {$name} {$this->getActionButtons($id)}
            </div>
            <ol class="dd-list">
                {$handle}
            </ol>
        </li>
Eof;
		return $html;
	}

	/**
	 * 菜单按钮
	 * @author 晚黎
	 * @date   2017-12-12
	 * @param  [type]     $id [description]
	 * @return [type]         [description]
	 */
	protected function getActionButtons($id)
	{
		$action = '<div class="pull-right">';
		$encodeId =  [encodeId($id)];
		if (haspermission('menucontroller.show')) {
			$action .= '<a href="javascript:;" class="btn btn-xs tooltips showInfo" data-href="'.route('category.show',  $encodeId).'" data-toggle="tooltip" data-original-title="查看"  data-placement="top"><i class="fa fa-eye"></i></a>';
		}
		if (haspermission('menucontroller.edit')) {
			$action .= '<a href="javascript:;" data-href="'.route('category.edit', $encodeId).'" class="btn btn-xs tooltips editMenu" data-toggle="tooltip"data-original-title="编辑"  data-placement="top"><i class="fa fa-edit"></i></a>';
		}
		if (haspermission('menucontroller.destroy')) {
			$action .= '<a href="javascript:;" class="btn btn-xs tooltips destroy_item" data-id="'.$id.'" data-original-title="删除"data-toggle="tooltip"  data-placement="top"><i class="fa fa-trash"></i><form action="'.route('category.destroy',  $encodeId).'" method="POST" style="display:none"><input type="hidden"name="_method" value="delete"><input type="hidden" name="_token" value="'.csrf_token().'"></form></a>';
		}
		$action .= '</div>';
		return $action;
	}
	/**
	 * 根据用户不同的权限显示不同的内容
	 * @author 晚黎
	 * @date   2017-12-12
	 * @return [type]     [description]
	 */
	public function canCreateMenu()
	{
		$canCreateMenu = haspermission('categorycontroller.create');

		$title = $canCreateMenu ?  'Welcome ！':'Sorry ！';
		$desc = $canCreateMenu ? '你可以操作左侧分类列表，或者点击下面添加按钮新增分类！':'暂无权限添加分类';
		$createButton = $canCreateMenu ? '<br><a href="javascript:;" class="btn btn-primary m-t create_menu">创建分类</a>':'';
		return <<<Eof
		<div class="middle-box text-center animated fadeInRightBig">
            <h3 class="font-bold">{$title}</h3>
            <div class="error-desc">
                {$desc}{$createButton}
            </div>
        </div>
Eof;
	}
	/**
	 * 上级分类
	 * @author 晚黎
	 * @date   2017-12-15
	 * @param  [type]     $menus [description]
	 * @param  string     $pid   [description]
	 * @return [type]            [description]
	 */
	public function topCategoryList($menus,$pid = '')
	{
		$html = '<option value="0">顶级分类</option>';
		if ($menus) {
			foreach ($menus as $v) {
				if (isset($v['pid']) && $v['pid']) {
					continue;
				}
				$html .= '<option value="'.$v['id'].'" '.$this->checkMenu($v['id'],$pid).'>'.$v['name'].'</option>';
			}
		}
		return $html;
	}

	public function checkMenu($menuId,$pid)
	{
		if ($pid !== '') {
			if ($menuId == $pid) {
				return 'selected="selected"';
			}
			return '';
		}
		return '';
	}
	
	/**
	 * 分类名称
	 * @author 晚黎
	 * @date   2017-12-15
	 * @param  [type]     $menus [description]
	 * @param  [type]     $pid   [description]
	 * @return [type]            [description]
	 */
	public function topCategoryName($menus,$pid)
	{
		if ($pid == 0) {
			return '顶级菜单';
		}
		if ($menus) {
			foreach ($menus as $v) {
				if ($v['id'] == $pid) {
					return $v['name'];
				}
			}
		}
		return '';
	}
}