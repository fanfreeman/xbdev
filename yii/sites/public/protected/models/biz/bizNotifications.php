<?php
/**
* 
*/

class bizNotifications
{

	/**
	 * add notification from notification table
	 * 添加通告
	 * $user_id : 用户id
	 * $notification_id : 通告id
	 * $$notification_type : 通告类型
	 * @return bool
	 */
	public static function add($user_id, $resource_id, $resource_type)
	{
		if($user_id!=Yii::app()->user->id)
		{
			$objNotifications = new Notifications();
			if (empty($user_id) || empty($resource_id) || empty($resource_type)) {
				return false;
			}
			$objNotifications->user_id = $user_id;
			$objNotifications->resource_id = $resource_id;
			$objNotifications->resource_type = $resource_type;
			$objNotifications->is_read = "0";
			$objNotifications->created = time();
			if(!$objNotifications->save()) {
				return false;
			}
		}
			return true;
	}

	/**
	 * add friend from follow table
	 * 删除关注关系
	 * $user_id : 用户id
	 * $following_id : 关注者id
	 * @return bool
	 */
	public static function delete($user_id, $resource_id, $resource_type)
	{
		if (empty($user_id) || empty($resource_id) || empty($resource_type)) {
            return false;
        }
        $objNotifications = new Notifications();
		if( $objNotifications->deleteAll("user_id = :user_id and resource_id = :resource_id and resource_type = :resource_type", array(
			':user_id'=>$user_id,
			':resource_id'=>$resource_id,
			':resource_type'=>$resource_type,
			)) > 0)
			return true;
		return false;
	}

	/**
	 * get notification from notification table
	 * 获取用户的通告
	 * $user_id : 用户id
	 * $count : 每页条数
	 * $page : 页数
	 * @return array('data'=>intdata, 'next_page' => $next_page);data为显示内容，next_page为下一页的值
	 */
	public static function getList($user_id, $page = 1, $count = 20)
	{
		$objNotifications = new Notifications();
  		//判断参数是否错误
  		if ( empty($user_id) ) {
            return false;
        }

        if ($count == 0) {
            $count = 20;
        }

        $intNum = $objNotifications->count("", array('user_id' => $user_id,));
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
        $criteria->addCondition("user_id = $user_id");
        $objData = $objNotifications->findAll($criteria);

		if (empty($objData)) {
            $arrayData = array();
        }else{
        	foreach($objData as $value) {
        		$arrayData[] = $value->getAttributes();
        		$objNotifications->updateByPk($value->notification_id, array('is_read'=>1));
        	}
        }

		return array(
			'data' => $arrayData,
			'next_page' => $intNext_page,
			);
	}
	
	public static function getTypeNotification($resource_type)
	{
		switch($resource_type){
			case("1"):{ return("file");break;}
			case("2"):{ return("commented on your newsfeed");break;}
			case("3"):{ return("liked on your newsfeed");break;}
			default:break;
			}
		}
	
	/**
	 * 获取消息提醒的条数
	 * $intUserId: 用户Id
	 * @return int 成功返回 条数，失败返回 false
	 */	
    public static function getNonReadNotification($intUserId)
    {
        if (empty($intUserId)) {
            return false;
        }

        $objCriteria = new CDbCriteria(array(
	        'condition' => 'user_id  = '.$intUserId,
	    ));

		$objCriteria->addCondition('is_read = 0', 'AND');
		$objNotification = new Notifications;

        return $objNotification->count($objCriteria);
    }
	
}