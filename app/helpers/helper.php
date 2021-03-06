<?php
/**
 * 主题下视图文件路径
 */
if(!function_exists('getThemeView')){
	function getThemeView($view)
	{
		return 'themes.admin.'.getTheme().'.'.$view;
	}
}

/**
 * 获取主题
 */
if(!function_exists('getTheme')){
	function getTheme()
	{
		if (cache()->has('theme')) {
			return cache('theme');
		}
		$theme = config('iwanli.global.theme');
		cache()->forever('theme', $theme);
		return $theme;
	}
}

/**
 * 获取页面资源文件
 */
if(!function_exists('getThemeAssets')){
	function getThemeAssets($asset, $vendors = false)
	{
		return $vendors ? 'vendors/'.$asset : 'themes/admin/'.getTheme().'/'.$asset;
	}
}

/**
 * 刷新用户权限、角色
 */
if(!function_exists('setUserPermissions')){
	function setUserPermissions($user)
	{
		$rolePermissions = $user->rolePermissions()->get()->pluck('slug');
        $userPermissions = $user->userPermissions()->get()->pluck('slug');
        $permissions = array_unique($rolePermissions->merge($userPermissions)->all());

        $roles = $user->getRoles()->pluck('slug')->all();
        $allPermissions = \App\Models\Permission::all()->pluck('slug')->all();

        // 缓存用户权限
        cache()->forever('user_'.$user->id, [
        	'permissions' => $permissions,
        	'roles' => $roles,
        	'allPermissions' => $allPermissions
        ]);
	}
}

/**
 * 清空缓存
 */
if(!function_exists('cacheClear')){
	function cacheClear()
	{
		cache()->flush();
	}
}
/**
 * 获取当前用户权限、角色
 */
if(!function_exists('getCurrentPermission')){
	function getCurrentPermission($user)
	{
		$key = 'user_'.$user->id;

		if (cache()->has($key)) {
			return cache($key);
		}

		setUserPermissions($user);

		return cache($key);
	}
}
/**
 * 操作提示信息
 */
if(!function_exists('flash_info')){
	function flash_info($result,$successMsg = 'success !',$errorMsg = 'something error !')
	{
		return $result ? flash($successMsg,'success')->important() : flash($errorMsg,'danger')->important();
	}
}

/**
 * 加密
 */
if(!function_exists('encodeId')){
	function encodeId($id,$connection = 'main')
	{
		if (!config('hashids.connections.'.$connection)) {
			$connection = 'main';
		}
		// 获取加密配置
		if(config('iwanli.global.encrypt')){
			return Hashids::connection($connection)->encode($id);
		}
		return $id;
	}
}

if(!function_exists('decodeId')){
	function decodeId($id,$connection = 'main', $type = false)
	{
		if (!config('hashids.connections.'.$connection)) {
			$connection = 'main';
		}

		// 获取加密配置
		$settings = config('iwanli.global.encrypt');
		// 判断是否开启加密设置
		
		if(config('iwanli.global.encrypt')){
			$id = Hashids::connection($connection)->decode($id);
			if ($id) {
				return $type ? $id:$id[0];
			}
			return 0;
		}
		return $id;
	}
}

if(!function_exists('haspermission')){
	function haspermission($permission)
	{
        $check = false;
        if (auth()->check()) {
            
            $user = auth()->user();
            $userPermissions =  getCurrentPermission($user);

            $check = in_array($permission, (array)$userPermissions['permissions']);

            if (in_array('admin', (array)$userPermissions['roles']) && !$check) {
                $newPermission = \App\Models\Permission::firstOrCreate([
                    'slug' => $permission,
                ],[
                    'name' => $permission,
                    'description' => $permission,
                ]);
                $role = \App\Models\Role::where('slug', 'admin')->first();
                $role->attachPermission($newPermission);
                setUserPermissions($user);
                $check = true;
            }
        }
        return $check;
	}
}

if(!function_exists('lead')){
	function lead($body, $limit = 500)
	{
	    $pattern = '/[^\<](\/)[^>]/i';
	    $body = preg_replace_callback($pattern, function($matches){
	        return preg_replace('/\//i', '@', $matches[0]);
	    }, htmlspecialchars_decode($body) );

	    $now_clip_size = 0;
	    $o_size = mb_strlen($body, 'utf-8');
	    if($o_size <= $limit) return $body;

	    $stack_arr = array();
	    $html_str = '';
	    $is_start = 0;
	    $tags_special   = array('img','br','hr');
	    $clip_index     = 0;
	    for($i=0; $i < $o_size; $i++){
	        $char = mb_substr($body, $i, 1);
	        $stack_length = count($stack_arr);
	        if( '<' == $char ){
	            array_push($stack_arr, $char);
	            $is_start = 1;
	        }else if( 1 == $is_start){

	            if( '>' == $char ){
	                $tag = is_htmltag($html_str);
	                if( in_array($tag, $tags_special) ){
	                    //是特殊tag时，若栈尾是'<'就弹出
	                    if($stack_length > 0 && '<' == $stack_arr[$stack_length-1]){
	                        array_pop($stack_arr);
	                    }
	                }else{
	                    //tag与栈尾元素一致,则弹出
	                    if($tag == $stack_arr[$stack_length-1]){
	                        array_pop($stack_arr);
	                        array_pop($stack_arr); //弹出了标签名，接着一定可以弹出'<'
	                    }else{
	                        array_push($stack_arr, $tag);
	                        array_push($stack_arr, $char);
	                    }
	                }
	                $is_start = 0;
	                $html_str = '';
	            }else if( '/' == $char ){
	                //紧跟开始标签'<'之后,表示dom结点结束
	                if( '' == trim($html_str) ){
	                    //先弹出'<',后弹出'>'
	                    array_pop($stack_arr);  
	                    array_pop($stack_arr);  
	                }

	            }else{
	                //拼接html标签字符串
	                $html_str .= $char;
	            }

	        }else{
	            // 非 html 代码才记数
	            $now_clip_size++;
	        }
	        // echo $i."<br>";
	        // echo $now_clip_size."<br>";
	        if(empty($stack_arr) && $now_clip_size >= $limit){
	            $clip_index = $i;
	            break;
	        }
	    }
	    $summary = mb_substr($body, 0, $clip_index+1);
	    $new_summary = preg_replace('/\@/i', '/', $summary);
	    return $new_summary;
	}
}

if(!function_exists('is_htmltag')){
	function is_htmltag($html_str){
	    $trim_str = trim($html_str);
	    $ex_arr = explode(' ', $trim_str);
	    $tag_name = $ex_arr[0];
	    $strip_str = strip_tags(trim('<'.$tag_name.'>'));
	    if(0 == strlen($strip_str)){
	        return $tag_name;
	    }else{
	        return false;
	    }
	}
}