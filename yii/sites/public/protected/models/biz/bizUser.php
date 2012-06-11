<?php

class bizUser
{
    const UserOnlineTime = 1200;
    
    /**
     * 通过用户 ID,email 查找用户信息 getInfo($array)
     * 输入用户信息$array = array('userid'=>xxx, 'email'=>xxx)
     * @return $arrayData
     */
    public static function getInfo($array)
    {
        if (empty($array)) {
            return false;
        }

        if (isset($array['user_id'])) {
            $objUserinfo = Users::model()->find('user_id = :userid', array(':userid' => $array['user_id']));
        } elseif (isset($array['email'])) {
            $objUserinfo = Users::model()->find('email = :email', array(':email' => $array['email']));
        } else {
            return false;
        }

		if (empty($objUserinfo)) {
			return false;
		}

        $arrayData = $objUserinfo->getAttributes();
        $arrayData['isOnline'] = !(time() - $arrayData['onlinetime'] > self::UserOnlineTime);

        return $arrayData;
    }

    /**
     * 用户注册 register($array)
     * 输入用户信息$array
     * @return bool
     */
    public static function register($arrayInfo)
    {
        $objUser = new Users;

        $objUser->password = Password::encrypt($arrayInfo['password']);
        $objUser->firstname = $arrayInfo['firstname'];
        $objUser->lastname = $arrayInfo['lastname'];
        $objUser->email = $arrayInfo['email'];

        $intTime_now = time();
        $objUser->created = $intTime_now;
        $objUser->updated = $intTime_now;

        if (!$objUser->save()) {
            return false;
        }
        
        return $objUser->attributes['user_id'];
    }

    /**
     * 用户信息修改 update($intUserId, $arrarInfo)
     * 输入用户信息 用户ID:$intUserId 用户修改信息:$arrarInfo
     * @return bool
     */
    public static function update($intUser_id, $arrayInfo)
    {
        if (empty($intUser_id) || empty($arrayInfo)) {
            return false;
        }

        if (!$arrayInfoNew = array_intersect_key($arrayInfo, array_fill_keys(array('email', 'firstname', 'lastname', 'password', 'onlinetime'), ''))) {
            return false;
        }

        if (isset($arrayInfoNew['password'])) {
            $arrayInfoNew['password'] = Password::encrypt($arrayInfoNew['password']);
        }

        $arrayInfoNew['updated'] = time();

        if (!Users::model()->updateAll($arrayInfoNew, 'user_id = :user_id', array(':user_id' => $intUser_id))) {
            return false;
        }

        return true;
    }
    
    
    /**
     * 获取用户的关注者的 newsfeed
     * @param $arrayParam 用户ID user_id,  max_id, since_id
     *        $intCount 每页的条数，默认每页显示20条
     *        $intPage 第几页，默认第1页
     * @return array(
     *      'data' => array,
     *      'total' => '总记录数',
     * );
     */

    public static function getFollowingFeed($arrayParam, $intCount = 20, $intPage = 1)
    {
        if (empty($arrayParam['user_id'])) {
            return false;
        }

        $objNewsFeeds = new NewsFeeds;
        $arrayData = array();
        $intUserId = $arrayParam['user_id'];
        $arrayUserId = bizFollower::getAllFolowers($intUserId);
        $arrayUserId[] = $intUserId;

        $criteria = new CDbCriteria(array(
                'order' => 'created DESC',
                'limit' => $intCount,
                'offset' => ($intPage-1)*$intCount,
        ));
        $criteria->addInCondition('user_id', $arrayUserId);

        if (isset($arrayParam['max_id'])) {
            $criteria->addCondition("newsfeed_id <= ".$arrayParam['max_id'], 'AND');
        }
        if (isset($arrayParam['since_id'])) {
            $criteria->addCondition("newsfeed_id >= ".$arrayParam['since_id'], 'AND');
        }
        
        $intTotal = $objNewsFeeds->count($criteria);
        $objData = $objNewsFeeds->findAll($criteria);

        foreach($objData as $value) {
			$arrayAttr = $value->getAttributes();
			if ($arrayAttr['params']) {
				$arrayAttr['params'] = unserialize($arrayAttr['params']);
			}
            //查询评论数
			$intCommentNum = FeedComments::model()->count('newsfeed_id = '.$arrayAttr['newsfeed_id']);
            $arrayAttr['commontNum'] = $intCommentNum;
			//查询喜欢数
			$arrayAttr["intLikedNum"] = bizLikes::countLiked($arrayAttr['newsfeed_id'], "3");
			//查询该newsfeed是否被关注
			$arrayAttr['checkLiked'] = bizLikes::checkLiked($intUserId, $arrayAttr['newsfeed_id'], "3");
			$arrayData[] = $arrayAttr;
        }

        return array(
            'data' => $arrayData,
            'total' => $intTotal,
        );
    }

    public static function getNewNewsfeedId($arrayParam)
    {
        if (empty($arrayParam['user_id'])) {
            return false;
        }

        $objNewsFeeds = new NewsFeeds;
        $arrayData = array();
        $intUserId = $arrayParam['user_id'];
        $arrayUserId = bizFollower::getAllFolowers($intUserId);
        $arrayUserId[] = $intUserId;

        $criteria = new CDbCriteria(array(
                'order' => 'created DESC',
        ));
        $criteria->addInCondition('user_id', $arrayUserId);
		$criteria->addCondition("newsfeed_id > ".$arrayParam['first_newsfeed_id'], 'AND');
		 
        
        $intTotal = $objNewsFeeds->count($criteria);
        return array(
            'intTotal' => $intTotal
        );
    }
	
    /**
     * 获取单个用户的 newsfeed
     * @param $intUserId 用户ID
     *        $intCount 每页的条数，默认每页显示20条
     *        $intPage 第几页，默认第1页
     * @return array(
     *      'data' => array,
     *      'total' => '总记录数',
     * );
     */
    public static function getUserFeed($intUserId, $intCount = 20, $intPage = 1)
    {
        if (empty($intUserId)) {
            return false;
        }

        $objNewsfeeds = new NewsFeeds;
        $arrayData = array();
        $criteria = new CDbCriteria(array(
                'condition' => 'user_id = '.$intUserId,
                'order' => 'created DESC',
                'limit' => $intCount,
                'offset' => ($intPage-1)*$intCount,
        ));

        $intTotal = $objNewsfeeds->count($criteria);
        $objData = $objNewsfeeds->findAll($criteria);	
        foreach($objData as $value) {
            $arrayAttr = $value->getAttributes();
            if ($arrayAttr['params']) {
                $arrayAttr['params'] = unserialize($arrayAttr['params']);
            }
            $intCommentNum = FeedComments::model()->count('newsfeed_id = '.$arrayAttr['newsfeed_id']);
            $arrayAttr['commontNum'] = $intCommentNum;
            $arrayData[] = $arrayAttr;
        }

        return array(
            'data' => $arrayData,
            'total' => $intTotal,
        );
    }
    
    /**
     * 获取用户组的 newsfeed
     * @param $intGroupId 用户组ID
     *        $intCount 每页的条数，默认每页显示20条
     *        $intPage 第几页，默认第1页
     * @return array(
     *      'data' => array,
     *      'total' => '总记录数',
     * );
     */
    public static function getGroupFeed($intGroupId, $intCount = 20, $intPage = 1)
    {
        if (empty($intGroupId)) {
            return false;
        }
        
        $objNewsfeeds = new NewsFeeds;
        $arrayData = array();
        $criteria = new CDbCriteria(array(
                'condition' => 'group_id = '.$intGroupId,
                'order' => 'created DESC',
                'limit' => $intCount,
                'offset' => ($intPage-1)*$intCount,
        ));
        $intTotal = $objNewsfeeds->count($criteria);
        $objData = $objNewsfeeds->findAll($criteria);
		
        foreach($objData as $value) {
            $arrayAttr[] = $value->getAttributes();
            if ($arrayAttr['params']) {
                $arrayAttr['params'] = unserialize($arrayAttr['params']);
            }
            $intCommentNum = FeedComments::model()->count('newsfeed_id = '.$arrayAttr['newsfeed_id']);
            $arrayAttr['commontNum'] = $intCommentNum;
            $arrayData[] = $arrayAttr;
        }

        return array(
            'data' => $arrayData,
            'total' => $intTotal,
        );
    }

    /**
     * 查找登陆信息 loadAllUserLoginById($intUser_id)
     * 通过用户ID查找用户登录信息
     * @return array 返回登录信息, 失败返回空数组
     */
    public static function loadAllUserLoginById($intUser_id)
    {
        $arrayData = array();
         $criteria = new CDbCriteria(array(
            'condition' => 'user_id = '.$intUser_id,
            'order' => 'accessed DESC'));
        if ($objInfo = User_login::model()->findAll($criteria)) {
            foreach ($objInfo as $key => $objVal) {
                $arrayData[] = $objVal->user_login_id;
            }
        }

        return $arrayData;
    }
	
	public static function getUserIdByname($str_search,$str_hide,$limit)
		{
			 if (empty($str_search)) {
            	return false;
        		}
			$str_search = trim($str_search);
			/*
			if (!ctype_alpha(substr($str_search,0,1)))
				{
				return false;
				}
			*/
			 $arrayAttrUsers = array(Yii::app()->user->id);
			 if ($str_hide!='')
		 		{
					$array_users= explode("_",$str_hide);
					foreach($array_users as $user_id)
						{
						array_push($arrayAttrUsers,$user_id);
						}
	      		}
			
			$array_str_search =explode(" ",$str_search);
			
			 if (count($array_str_search)==2)
				 {
					$criteria = new CDbCriteria(array(
									'condition' => "(firstname like '".$array_str_search[0]."%' and lastname like '".$array_str_search[1]."%')",
									'order' => 'created ASC',
									'limit' => $limit,
							));	 
				 }
				 else
				 {
					 $criteria = new CDbCriteria(array(
									'condition' => "(firstname like '".$str_search."%' or lastname like '".$str_search."%')",
									'order' => 'created ASC',
									'limit' => $limit,
							));
				 }
			$criteria->addNotInCondition('user_id', $arrayAttrUsers);
			$objUsers = new Users;
			$objData = $objUsers->findAll($criteria);
			if (empty($objData)){ return false;}
			$arrayData = array();
			foreach($objData as $value) {
				$arrayAttr = $value->getAttributes();
				$temp['user_id'] = $arrayAttr['user_id'];
				$temp['firstname'] = $arrayAttr['firstname'];
				$temp['lastname'] = $arrayAttr['lastname'];
				$temp['avatar'] = $arrayAttr['avatar'];
				$arrayData[]= $temp;
				}
				return $arrayData;
		}
}



?>