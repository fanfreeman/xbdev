<?php

class FollowsController extends CController
{
	public function actions()
    {
        return array(
            'index'=>array(
                'class'=>'CWebServiceAction',
            ),
        );
    }

    /**
     * 
     * @param int followerId
     * @param int followingId
     * @return mixed success
     * @soap
     */
    public function add($intFollowerId, $intFollowingId)
    {
    	try {
            $intFollowerId = intval($intFollowerId);
            $intFollowingId = intval($intFollowingId);
            if (empty($intFollowerId) || empty($intFollowerId)) {
                throw new Exception("empty user_id or following_id", 1);
            }
            if (!$user_info = bizUser::getInfo(array('user_id'=>$intFollowerId))) {
                throw new Exception("folloer user not exist", 1);
            }
            if (!$user_info = bizUser::getInfo(array('user_id'=>$intFollowingId))) {
                throw new Exception("Following user not exist", 1);
            }

            if (!$result = bizFollower::add($intFollowerId, $intFollowingId)) {
                throw new Exception("model error", 1);
            }
        } catch (Exception $e) {
            return  array(
                'error' => $e->getMessage();
            );
        }

        return $result;
    }

    /**
     * 
     * @param int followerId
     * @param int followingId
     * @return mixed success
     * @soap
     */
    public function delete($intFollowerId, $intFollowingId)
    {
    	try {
            $intFollowerId = intval($intFollowerId);
            $intFollowingId = intval($intFollowingId);
            if (empty($intFollowerId) || empty($intFollowerId)) {
                throw new Exception("empty user_id or following_id", 1);
            }
            if (!$user_info = bizUser::getInfo(array('user_id'=>$intFollowerId))) {
                throw new Exception("folloer user not exist", 1);
            }
            if (!$user_info = bizUser::getInfo(array('user_id'=>$intFollowingId))) {
                throw new Exception("Following user not exist", 1);
            }

            if (!$result = bizFollower::delete($intFollowerId, $intFollowingId)) {
                throw new Exception("model error", 1);
            }
        } catch (Exception $e) {
            return  array(
                'error' => $e->getMessage();
            );
        }
        
        return $result;
    }

    /**
     * 
     * @param int intUserId
     * @return mixed Data
     * @soap
     */
    public function getAllFolowers($intUserId)
    {
    	try {
            $intUserId = intval($intUserId);
            if (empty($intUserId)) {
                throw new Exception("empty user_id", 1);
            }
            if (!$user_info = bizUser::getInfo(array('user_id'=>$intUserId))) {
                throw new Exception("folloer user not exist", 1);
            }

            if (!$result = bizFollower::getAllFolowers($intUserId)) {
                throw new Exception("model error", 1);
            }
        } catch (Exception $e) {
            return  array(
                'error' => $e->getMessage();
            );
        }
        
        return $result;
    }

    /**
     * 
     * @param int intUserId
     * @return mixed Data
     * @soap
     */
    public function getList($intUserId)
    {
    	try {
            $intUserId = intval($intUserId);
            if (empty($intUserId)) {
                throw new Exception("empty user_id", 1);
            }
            if (!$user_info = bizUser::getInfo(array('user_id'=>$intUserId))) {
                throw new Exception("folloer user not exist", 1);
            }

            if (!$result = bizFollower::getList($intUserId)) {
                throw new Exception("model error", 1);
            }
        } catch (Exception $e) {
            return  array(
                'error' => $e->getMessage();
            );
        }
        
        return $result;
    }
}