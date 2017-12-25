<?php
namespace App\Repositories\Traits;

use App\Models\Recommand;
use PRedis;

trait RecommandTrait {

    public function getRecommandList()
    {
        // 推荐文章使用 redis 存储
        if (env('CACHE_DRIVER', 'file') == 'redis') {
            return $this->zrevrange(0, 10);
        }
        return $this->RecommandListByTable();
    }

    /**
     * 获取推荐列表
     * @author 晚黎
     * @date   2017-12-25
     */
    public function RecommandListByTable()
    {
    	return Recommand::orderBy('score', 'desc')->take(10)->get()->toArray();
    }

    /**
     * 更新推荐文章数据
     * @author 晚黎
     * @date   2017-12-25
     * @param  [type]     $data      [description]
     * @param  [type]     $articleId [description]
     * @return [type]                [description]
     */
    public function updateRecommandArticle($score, $articleId)
    {
    	return Recommand::where('article_id', $articleId)->increment('score', $score);
    }

    /**
     * 获取有序集合元素，按照分值倒序排列
     * @author 晚黎
     * @date   2017-12-25
     * @param  integer    $start [description]
     * @param  integer    $end   [description]
     * @return [type]            [description]
     */
    public function zrevrange($start = 0, $end = -1)
	{
		return PRedis::zrevrange(config('iwanli.global.redis.zset'), $start, $end);
	}
	/**
	 * 更新有序集合中元素的分数
	 * @author 晚黎
	 * @date   2017-12-25
	 * @param  [type]     $score [description]
	 * @param  [type]     $key   [description]
	 * @return [type]            [description]
	 */
	public function zincrbyScore($score, $key)
    {
        return PRedis::zincrby(config('iwanli.global.redis.zset'), $score, $key);
    }
}