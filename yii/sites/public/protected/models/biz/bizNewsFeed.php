<?php

/*
 * This file is part of the Geek-Zoo Projects.
 *
 * @copyright (c) 2010 Geek-Zoo Projects More info http://www.geek-zoo.com
 * @license http://opensource.org/licenses/gpl-2.0.php The GNU General Public License
 * @author xuanyan <xuanyan@geek-zoo.com>
 *
 */


class bizNewsFeed
{
	
	const FeedType = 1;

    /**
     * 添加一条newsfeed
     * @param $intUserId 用户Id
     *        $intGroupId 所属群组Id
     *        $intResId 资源Id
     *        $strType 资源类型
     *        $arrayParams 内容
     * @return bool 成功返回 newsfeed_id, 失败返回false
     */
    public static function add($intUserId, $intResId, $strType, $intGroupId = 0, $arrayParams = array())
    {
        $objNewsfeeds = new NewsFeeds;
        
        if (empty($intUserId) || empty($intResId) || empty($strType)) {
            return false;
        }

        $objNewsfeeds->user_id = $intUserId;
        $objNewsfeeds->resource_id = $intResId;
        $objNewsfeeds->group_id = $intGroupId;
        $objNewsfeeds->resource_type = $strType;
        if ($arrayParams) {
            $objNewsfeeds->params = serialize($arrayParams);
        }
        $objNewsfeeds->created = time();

        if (!$objNewsfeeds->save()) {
            return false;
        }
		
        return $objNewsfeeds["newsfeed_id"];
    }
    
    /**
     * 获取一条newsfeed内容
     * $param $intFeedId 用户新鲜事Id
     * $return int(
     *       'data' => $arrayData, //以数组的形式返回newsfeed的内容
     * );
     */
    public static function getNewsFeed($intFeedId)
    {	
        if (empty($intFeedId)) {
            return false;
        }

        $objData = NewsFeeds::model()->findByPk($intFeedId);
        $arrayData = $objData->getAttributes();

		if ($arrayData['params']) {
			$arrayData['params'] = unserialize($arrayData['params']);
		}

        $intCommentNum = FeedComments::model()->count('newsfeed_id = '.$arrayData['newsfeed_id']);
        $arrayData['commontNum'] = $intCommentNum;
        //查询喜欢数
		$arrayData["intLikedNum"] = bizLikes::countLiked($arrayData['newsfeed_id'], "3");
        return array(
                'data' => $arrayData,
        );
        
    }


    /**
     * 获取一条newsfeed的评论数
     * $intFeedId NewsFeed_Id
     * $return int();
     */
    public static function getCommentNum($intFeedId)
    {
        if (empty($intFeedId)) {
            return false;
        }

        $intCommentNum = FeedComments::model()->count('newsfeed_id = '.$intFeedId);
        return($intCommentNum);
    }
	
    /**
     * 删除newsfeed
     * @param $intFeedId 用户新鲜事Id
     * @return bool 成功返回 true, 失败返回 false
     */
    public static function delete($intFeedId)
    {
        if (empty($intFeedId)) {
            return false;
        }
        
        $objNewsfeeds = NewsFeeds::model()->findByPk($intFeedId);

        if (!$objNewsfeeds->delete()) {
            return false;
        }

        return true;
    }

    /**
     * 添加newsfeed评论
     * @param $intFeedId 用户新鲜事Id
     *        $intUserId 用户Id
     *        $strContent 评论内容
     *        $intReplyToId 回复Id
     * @return bool 成功返回 true, 失败返回 false
     */
    public static function addComment($intUserId, $intFeedId, $strContent, $intReplyToId = 0)
    {
        $objFeedcomments = new FeedComments;
        
        if (empty($intUserId) || empty($intFeedId) || empty($strContent)) {
            return false;
        }

        $objFeedcomments->newsfeed_id = $intFeedId;
        $objFeedcomments->user_id = $intUserId;

        if ($strContent) {
            $objFeedcomments->content = serialize($strContent);
        }
		$objFeedcomments->created = time();
        $objFeedcomments->reply_to_id = $intReplyToId;
     
        if (!$objFeedcomments->save())
        {
            return false;
        }
		else
		{
			return($objFeedcomments->feedcomment_id);
			}
    }

    /**
     * 获取newsfeed评论列表
     * $param $intFeedId 用户新鲜事的Id
     *        $intCount 每页显示条数，默认每页显示20条
     *        $intPage 第几页，默认第1
     * $return array(
     *      'data' => $arrayData, // 返回newsfeed评论列表的数组
     *      'total' => $intTotal, // 返回newsfeed评论的总记录数
     * );
     */
    public static function getComments($intFeedId, $intCount = 20, $intPage = 1, $addCondition)
    {
        if (empty($intFeedId)) {
            return false;
        }
        
         $criteria = new CDbCriteria(array(
                'condition' => 'newsfeed_id = '.$intFeedId,
                'order' => 'created DESC',
                'limit' => $intCount,
                'offset' => ($intPage-1)*$intCount,
        ));
		 
        if (isset($addCondition['max_id'])) {
            $criteria->addCondition("feedcomment_id <= ".$addCondition['max_id'], 'AND');
        }
        if (isset($addCondition['since_id'])) {
            $criteria->addCondition("feedcomment_id >= ".$addCondition['since_id'], 'AND');
        }
		
        
        $objFeedcomments = new FeedComments;
        $intTotal = $objFeedcomments->count($criteria);
        $objData = $objFeedcomments->findAll($criteria);

        $arrayData = array();
        foreach($objData as $value) {
            $arrayAttr = $value->getAttributes();
			if ($arrayAttr['content']) {
				$arrayAttr['content'] = unserialize($arrayAttr['content']);
			}
			$arrayData[] = $arrayAttr;
        }
        return array(
            'data' => $arrayData,
            'total' => $intTotal,
        );
    }
    
}

?>
