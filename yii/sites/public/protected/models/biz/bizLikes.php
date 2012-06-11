<?php
/**
* 
*/

class bizLikes
{
	/**
	 * add likes from newsfeed table
	 * 添加通告
	 * $user_id : 用户id
	 * $like_id : 喜欢id
	 * $like_type : 喜欢类型
	 * @return bool
	 */ 
	public static function add($user_id, $resource_id, $resource_type)
	{
		if (empty($user_id) || empty($resource_id) || empty($resource_type)) {
            return false;
        } 
		$objLikes = new Likes();
		$objLikes->user_id = $user_id;
		$objLikes->resource_id = $resource_id;
		$objLikes->resource_type = $resource_type;
		$objLikes->created = time();
		if(!$objLikes->save()) {
		    return false;
		}

		return true;
	}
	
	public static function delete($user_id, $resource_id, $resource_type)
	{
		if (empty($user_id) || empty($resource_id) || empty($resource_type)) {
            return false;
        }
		$objLikes = new Likes();
		if( $objLikes->deleteAll("user_id = :user_id and resource_id = :resource_id and resource_type = :resource_type", array(
			':user_id'=>$user_id,
			':resource_id'=>$resource_id,
			':resource_type'=>$resource_type,
			)) > 0)
			return true;

		return false;
	}
    /**
     * 获取一条newsfeed的评论数
     * $intFeedId NewsFeed_Id
     * $return int();
     */
    public static function checkLiked($user_id, $resource_id, $resource_type)
    {
		if (empty($user_id) || empty($resource_id) || empty($resource_type)) {
            return false;
        }

        if(Likes::model()->count('user_id = '.$user_id." and resource_id = ".$resource_id." and resource_type =". $resource_type.""))
		{	return("liked");
			}
			else
			{
        	return("notLiked");
			}
    }

    public static function countLiked($resource_id, $resource_type)
    {
		if (empty($resource_id) || empty($resource_type)) {
            return false;
        }

        if($countLiked = Likes::model()->count("resource_id = ".$resource_id." and resource_type =". $resource_type.""))
		{	return($countLiked);
			}
		else return('0');
    }
}