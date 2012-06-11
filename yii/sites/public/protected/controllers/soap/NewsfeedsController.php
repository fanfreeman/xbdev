<?php

//  $client=new SoapClient('http://hostname/index.php?r=soap/stock');
//  $result =  $client->login($username, $password);

class NewsFeedsController extends CController
{
    public function actions()
    {
        return array(
            'index' => array(
                'class' => 'CWebServiceAction',
            ),
        );
    }

     /**
     * 添加一条newsfeed
     * @param $intUserId 用户Id
     *        $intGroupId 所属群组Id
     *        $intResId 资源Id
     *        $strType 资源类型
     *        $arrayParams 内容
     * @return bool 成功返回 newsfeed_id, 失败返回 array('error' => '错误信息');
     */
    public static function add($intUserId, $intResId, $strType, $intGroupId = 0, $arrayParams = array())
    {
        try {
            $intUserId = intval($intUserId);
            $intResId = intval($intResId);
            $strType = strval($strType);
            $intGroupId = intval($intGroupId);

            if (!is_array($arrayParams) {
                throw new Exception("params is not array", 1);
            }

            if (empty($intUserId) || empty($intResId) || empty($strType)) {
                throw new Exception("empty user_id or resource_id or resource_type", 1);
            }

            if (!$user_info = bizUser::getInfo(array('user_id' => $intUserId))) {
                throw new Exception("newsfeed user not exist", 1);
            }

            $result = bizNewsFeed::add($intUserId, $intResId, $strType, $intGroupId, $arrayParams);

            if (!$result) {
                throw new Exception("model error", 1);
            }

        } catch (Exception $e) {
            return array(
                'error' => $e->getMessage();
            );
        }

        return $result;
    }
    
     
    /**
     * 获取一条newsfeed内容
     * $param $intFeedId 用户新鲜事Id
     * $return array(
     *       'data' => $arrayData, //以数组的形式返回newsfeed的内容
     * );
     * 错误返回 array('error' => '错误信息');
     */
    public static function getNewsFeed($intFeedId)
    {
        try {
            $intFeedId = intval($intFeedId);

            if (empty($intFeedId)) {
                throw new Exception("newsfeed_id is empty", 1);
            }

            $result = bizNewsFeed::getNewsFeed($intFeedId);

            if (!$result) {
                throw new Exception("model error", 1);
            }

        } catch (Exception $e) {
            return array(
                'error' => $e->getMessage();
            );
        }

        return $result;
    }
    
    /**
     * 删除newsfeed
     * @param $intFeedId 用户新鲜事Id
     * @return bool 成功返回 true, 失败返回 array('error' => '错误信息');
     */
    public static function delete($intFeedId)
    {
        try {
            $intFeedId = intval($intFeedId);

            if (empty($intFeedId)) {
                throw new Exception("newsfeed_id is empty", 1);
            }

            $result = bizNewsFeed::delete($intFeedId);

            if (!$result) {
                throw new Exception("model error", 1);
            }

        } catch (Exception $e) {
            return array(
                'error' => $e->getMessage();
            );
        }

        return $result;
    }
    
    
    /**
     * 添加newsfeed评论
     * @param $intFeedId 用户新鲜事Id
     *        $intUserId 用户Id
     *        $strContent 评论内容
     *        $intReplyToId 回复Id
     * @return bool 成功返回 true, 失败返回 array('error' => '错误信息');
     */
    public static function addComment($intUserId, $intFeedId, $strContent, $intReplyToId = 0)
    {
        try {
            $intUserId = intval($intUserId);
            $intFeedId = intval($intFeedId);
            $strContent = strval($strContent);
            $intReplyToId = intval($intReplyToId);

            if (empty($intUserId) || empty($intFeedId) empty($strContent)) {
                throw new Exception("empty user_id or newsfeed_id or content");
            }

            if (!$user_info = bizUser::getInfo(array('user_id' => $intUserId))) {
                throw new Exception("feedcomments user not exist", 1);
            }

            $result = bizNewsFeed::addComment($intUserId, $intFeedId, $strContent, $intReplyToId);

            if (!$result) {
                throw new Exception("model error", 1);
            }
       
        } catch (Exception $e) {        
            return array(
                'error' => $e->getMessage();
            );
        }

        return $result;
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
     * 错误返回 array('error' => '错误信息');
     */
    public function getComments($intFeedId, $intCount = 20, $intPage = 1)
    {
        try {
            $intFeedId = intval($intFeedId);
            $intCount = intval($intCount);
            $intPage = intval($intPage);

            if (empty($intFeedId)) {
                throw new Exception("newsfeed_id is empty", 1);
            }

            $result = bizNewsFeed::getComments($intFeedId, $intCount, $intPage);

            if (!$result) {
                throw new Exception("model error", 1);
            }

        } catch {Exception $e) {
            return array(
                'error' => $e->getMessage();
            );
        }

        return $result;
    }


}
 
