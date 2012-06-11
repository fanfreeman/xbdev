<?php

class UserController extends CController
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
     * 查找用户信息 getInfo($array)
     * @param array('userid'=>用户id, 
     *				'email'=>用户邮箱)
     * 				输入其中一条就可以查找,优先级userid > email
     * @return array('user_id'=>用户ID,
     *				 'firstname'=>用户firstname,
     *				 'lastname'=>用户lastname,
     *				 'password'=>加密后密码,
     *				 'email'=>邮箱,
     *				 'created'=>注册时间,
     *				 'updated'=>用户更新时间,
     *				 'onlinetime'=>上一次活动时间
     *				 'isOnline'=>是否在线)
     * 错误返回 array('error'=>错误信息)
     */
    public static function getInfo($array)
    {
    	try {
    		if (!is_array($array)) {
                throw new Exception("param type not array", 1);
    		}
    		if (isset($array['userid'])) {
       			$array['userid'] = intval($array['userid']); 		
    		}
    		if (!(isset($array['userid']) || isset($array['email']))) {
    			throw new Exception("param empty", 1);
    		}
            $result = bizUser::getInfo($array);
            if (!$result) {
                throw new Exception("model error", 1);
            }
    		if (!bizUser::getInfo($array)){
    			throw new Exception("this userinfo not exist", 1);
    		}
    	} catch (Exception $e) {
            return  array(
                'error' => $e->getMessage();
            );
    	}
    	
    	return $result;
	}

    /**
     * 用户注册 register($array)
     * @param array(
     *				'password'=>密码, 
     *				'firstname'=>用户firstname, 
     *				'lastname'=>用户lastname, 
     *				'email'=>邮箱)
     * @return bool
     * 错误返回 array('error'=>错误信息)
     */
    public static function register($array)
	{
		try {
    		if (!is_array($array)) {
                throw new Exception("param type not array", 1);
    		}
			if($arrayInfo = array_intersect_key($array, array_fill_keys(array('password', 'firstname', 'lastname', 'email'), ''))) {
				throw new Exception("array function error", 1);
			}
			foreach ($arrayInfo as $key => $val) {
				if (empty($val)) {
					throw new Exception("$val"." can not empty", 1);
				}
			}		
			if (bizUser::getInfo(array('email'=>$arrayInfo['email']))) {
				throw new Exception("email:".$arrayInfo['email']."already exists", 1);
			}
			$result = bizUser::register($arrayInfo);
            if (!$result) {
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
     * 用户信息修改 update($intUserId, $arrarInfo)
     * @param $intUserId 用户ID,
     *		  $arrayInfo array('firstname'=>用户firstname, 
     *							'lastname'=>用户lastname, 
     *							'email'=>邮箱, 
     *							'password'=>密码)
     * @return bool
     * 错误返回 array('error'=>错误信息)
     */
    public static function update($intUser_id, $arrayInfo)
	{
		$intUser_id = intval($intUser_id);
		try {
    		if (!is_array($array)) {
                throw new Exception("param type not array", 1);
    		}
			if (empty($intUser_id) || empty($arrayInfo)) {
        	    throw new Exception("userid or userinfo empty", 1);
        	}
			if (!$arrayInfoNew = array_intersect_key($arrayInfo, array_fill_keys(array('email', 'firstname', 'lastname', 'password', 'onlinetime'), ''))){
            	throw new Exception("array function error", 1);
        	}
        	if (!bizUser::getInfo(array('user_id'=>$intUser_id))) {
        		throw new Exception("this user not exist", 1);
        	}
        	if (bizUser::getInfo(array('email'=>$arrayInfoNew['email']))) {
        		throw new Exception("email already exists", 1);
        	}
        	$result = bizUser::update($intUser_id, $arrayInfoNew);
            if (!$result) {
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
     * 获取用户的关注者的 newsfeed:getFollowingFeed($intUserId, $intCount = 20, $intPage = 1)
     * @param $intUserId 用户ID
     *        $intCount 每页的条数，默认每页显示20条
     *        $intPage 第几页，默认第1页
     * @return array(
     *      		'data' => array,
     *      		'total' => '总记录数',
     *			);
     * 错误返回 array('error'=>错误信息)
     */
    public static function getFollowingFeed($intUserId, $intCount = 20, $intPage = 1)
    {
    	$intUserId = intval($intUserId);
    	$intCount = intval($intCount);
    	$intPage = intval($intPage);
    	try {
    		if (empty($intUserId)) {
    			throw new Exception("userId empty", 1);
    		}
    		if ($intCount <= 0) {
    			throw new Exception("intCount value error", 1);
    		}
    		if ($intPage <= 0) {
    			throw new Exception("intPage value error", 1);
    		}
    		if (!bizUser::getInfo(array('user_id'=>$intUserId))) {
    			throw new Exception("userid not exist", 1);
    		}
    		$result = bizUser::getFollowingFeed($intUserId, $intCount, $intPage);
            if (!$result) {
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
     * 获取单个用户的 newsfeed
     * @param $intUserId 用户ID
     *        $intCount 每页的条数，默认每页显示20条
     *        $intPage 第几页，默认第1页
     * @return array(
     *      		'data' => array,
     *      		'total' => '总记录数',
     *			);
     * 错误返回 array('error'=>错误信息)
     */
    public static function getUserFeed($intUserId, $intCount = 20, $intPage = 1)
	{
    	$intUserId = intval($intUserId);
    	$intCount = intval($intCount);
    	$intPage = intval($intPage);
    	try {
    		if (empty($intUserId)) {
    			throw new Exception("userId empty", 1);
    		}
    		if ($intCount <= 0) {
    			throw new Exception("intCount value error", 1);
    		}
    		if ($intPage <= 0) {
    			throw new Exception("intPage value error", 1);
    		}
    		if (!bizUser::getInfo(array('user_id'=>$intUserId))) {
    			throw new Exception("userid not exist", 1);
    		}
    		$result = bizUser::getUserFeed($intUserId, $intCount, $intPage);
            if (!$result) {
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
     * 获取用户组的 newsfeed
     * @param $intGroupId 用户组ID
     *        $intCount 每页的条数，默认每页显示20条
     *        $intPage 第几页，默认第1页
     * @return array(
     *      		'data' => array,
     *      		'total' => '总记录数',
     *			);
     * 错误返回 array('error'=>错误信息)
     */
    public static function getGroupFeed($intGroupId, $intCount = 20, $intPage = 1)
	{
    	$intGroupId = intval($intGroupId);
    	$intCount = intval($intCount);
    	$intPage = intval($intPage);
    	try {
    		if (empty($intGroupId)) {
    			throw new Exception("groupId empty", 1);
    		}
    		if ($intCount <= 0) {
    			throw new Exception("intCount value error", 1);
    		}
    		if ($intPage <= 0) {
    			throw new Exception("intPage value error", 1);
    		}
    		$result = bizUser::getGroupFeed($intGroupId, $intCount, $intPage);
            if (!$result) {
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