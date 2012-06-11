<?php
     /**
     * 添加file评论
     * @param $intfileId 共享文件Id
     *        $intUserId 用户Id
     *        $strContent 评论内容
     * @return bool 成功返回 true, 失败返回 array('error' => '错误信息');
     */
    public static function addComment($intUserId, $infileId, $strContent)
    {
        try {
            $intUserId = intval($intUserId);
            $intfileId = intval($intfileId);
            $strContent = strval($strContent);

            if (empty($intUserId) || empty($intfileId) empty($strContent)) {
                throw new Exception("empty user_id or file_id or content");
            }

            if (!$user_info = bizUser::getInfo(array('user_id' => $intUserId))) {
                throw new Exception("comments user not exist", 1);
            }

            $result = bizFilecomments::addComment($intUserId, $intfileId, $strContent);

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
     * 获取file评论列表
     * @param $intfileId 共享文件Id
     *  $intCount 每页显示条数，默认每页显示5条
     *  $intPage 第几页，默认第1
     * $return array(
     *      'data' => $arrayData, // 返回file评论列表的数组
     *      'total' => $intTotal, // 返回file评论的总记录数
     * );
     * 错误返回 array('error' => '错误信息');
     */
    public function getComments($intfileId, $intCount = 5, $intPage = 1)
    {
        try {
            
            $intCount = intval($intCount);
            $intPage = intval($intPage);
            $intfileId = intval($intfileId);
            if (empty($intfileId)) {
                throw new Exception("file_id is empty", 1);
            }

            $result = bizNewsFeed::getComments($intfileId, $intCount, $intPage);

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