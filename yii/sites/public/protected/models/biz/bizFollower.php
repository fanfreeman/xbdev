<?php

class bizFollower
{
    /**
	 * add friend from follow table
	 * 关注一个人
	 * $intFollowerId : 用户id
	 * $intFollowingId : 关注者id
	 * @return bool
	 */
    public static function add($intFollowerId, $intFollowingId)
    {
        if (empty($intFollowerId) || empty($intFollowingId)) {
            return false;
        }

        if ($intFollowerId == $intFollowingId) {
            return false;
        }

        $objFollowers = new Follows();
        $objResult = $objFollowers->find("follower_id = :follower_id and following_id = :following_id",
            array(
                'follower_id' => $intFollowerId,
                'following_id' => $intFollowingId
            ));

        if (!$objResult) {
            $objFollowers->follower_id = $intFollowerId;
            $objFollowers->following_id = $intFollowingId;
            $objFollowers->created = time();
            $objFollowers->save();
        }

        return true;
    }

    /**
     * delete friend from follow table
     * 删除关注关系
     * $user_id : 用户id
     * $following_id : 关注者id
     * @return bool
     */
    public static function delete($user_id, $following_id)
    {
        $objFollowers = new Follows();
        if (empty($user_id) || empty($following_id)) {
            return false;
        }

     //   if ($intFollowerId == $intFollowingId) {
     //      return false;
      //  }

        if( $objFollowers->deleteAll("follower_id = $user_id and following_id = $following_id", array(
            'follower_id'=>$user_id,
            'following_id'=>$following_id,
            )) > 0)
            return true;

        return false;
    }

    /**
     * 得到用户的关注的人
     * $intUserId : 用户id
     * @return array();
     */
    public static function getAllFolowers($intUserId)
    {
        if (empty($intUserId)) {
            return flase;
        }

        $objFollowers = new Follows();
        $objData = $objFollowers -> findAllByAttributes(array('follower_id' => $intUserId));
        if (empty($objData)) {
            return array();
        }

        foreach ($objData as $key => $value) {
            $arrayData[$key] = $value->getAttributes();
            $arrayData[$key] = $arrayData[$key]['following_id'];
        }
        //var_dump($arrayData);
        return $arrayData;
    }

    /**
     * add friend from follow table
     * 获取用户的关注列表
     * $user_id : 用户id
     * $count : 每页条数
     * $page : 页数
     * @return array('data'=>data, 'next_page' => $next_page);data为显示内容，next_page为下一页的值
     */
    public static function getList($user_id, $page = 1, $count = 20)
    {
        $objFollowers = new Follows();
        //判断参数是否错误
        if ( empty($user_id) ) {
            return false;
        }

        if ($count == 0) {
            $count = 20;
        }

        $intNum = $objFollowers->count("", array('follower_id' => $user_id,));
        $intPagecount = ceil($intNum / $count);

        if($page == $intPagecount){
            $intNext_page = 0;
        }elseif($page > $intPagecount || $page < 1){
            return array(
                'data' => array(),
                'next_page' => 0,
                );
        }else{
            $intNext_page = $page + 1;
        }

        //获取数据
        $criteria = new CDbCriteria(array(
                  'order' => 'created DESC',
                  'limit' => $count,
                  'offset' => ($page-1)*$count,
          ));
        $criteria->addCondition("follower_id = $user_id");
        $objData = $objFollowers->findAll($criteria);

        if (empty($objData)) {
            $arrayData = array();
        }else {
            foreach($objData as $value) {
                $arrayData[] = $value->getAttributes();
            }
        }

        return array(
            'data' => $arrayData,
            'next_page' => $intNext_page,
            );
    }
	
    /**
     * 得两个用户是否互相关注
     * $intUserId : 用户id
     * @return array();
     */
    public static function checkFollower($follower_id,$following_id)
    {
        if (empty($follower_id)||empty($following_id)) {
            return false;
        }

        $objFollowers = new Follows();
        $objData = $objFollowers -> findAllByAttributes(array('follower_id' => $follower_id,'following_id' => $following_id));
        if (empty($objData)) {
            return false;
        }
		else
		{
				$arrayData = array();
				foreach($objData as $value) {
				$arrayAttr = $value->getAttributes();
				$arrayData[] = $arrayAttr;
				return ($arrayData[0]["follow_id"]);
				}
			}
    }	
}
?>