<?php

class bizMessages
{
     // 在一会话中添加回复
    public static function addReply($intMessageGroupId, $type, $intUserId, $strMessage)
    {
		$objReply = new Messages();
        $objReply->sender_id = $intUserId;
		$objReply->type = $type;
        $objReply->message_group_id = $intMessageGroupId;
        $objReply->message = $strMessage;
        $objReply->created = time();
        if (!$objReply->save()) {
			return false;
        }
		else
		{
			//发起者更新最后一个读取的ID！-------------------------------------
		
		if($intUserId!='0') //非系统消息
		{
			bizIm::update_last_message_id($objReply->message_id,$intMessageGroupId,$intUserId);
		}
		bizIm::send_last_message_id($objReply->message_id,$intMessageGroupId,$intUserId);
		
		//将该消息发送至message_archive
		bizMessageArchive::send_message_archive($objReply->message_id,$intMessageGroupId,$intUserId,$objReply->created);	
		
		return($objReply->message_id);
		
		}
		/*
		
        $objResult = MessageGroupMembers::model()->findAll("member_group_id = :member_group_id AND is_left = 0",
                                                            array(':member_group_id' => $intMessageGroupId));
        $objMessageNotification = new MessageNotifications();
        foreach ($objResult as $objMember) {
            if ($objMember->user_id == $intUserId) {
                continue;
            }
            $objResult = $objMessageNotification->find("member_group_id = :member_group_id AND user_id = :user_id", array(
                ':member_group_id' => $intMessageGroupId,
                ':user_id' => $objMember->user_id
            ));
            if (empty($objResult)) {
                $objMessageNotification->member_group_id = $intMessageGroupId;
                $objMessageNotification->user_id = $objMember->user_id;
                $objMessageNotification->new_message_count = 1;
                $objMessageNotification->save();
            } else {
                $objMessageNotification->updateAll(array('new_message_count'=>$objResult->new_message_count+1),
                 "message_notification_id = :message_notification_id",
                 array(':message_notification_id'=>$objResult->message_notification_id));
            }
        }
        return true;
		*/
    }
	
	public static function getMessageById($message_id)
    {
  		if ( empty($message_id) ) {
            return false;
        }
        //获取数据
		$objMessages = new Messages();
  		$objResult = $objMessages->find('message_id='.$message_id);
		if (!empty($objResult)) {
        	 $arrayAttr = $objResult->getAttributes();
			 return $arrayAttr;
		}	
	}
	
	// 获取会话列表,按未读信息数排列
    public static function getListMessage($message_group_id, $condition, $count = 20, $page = 1)
    {
		$objMessages = new Messages();
  		if ( empty($message_group_id) ) {
            return false;
        }
        //获取数据
  		$criteria = new CDbCriteria(array(
				  'condition' => 'message_group_id = '.$message_group_id .' and 1=1',
                  'order' => 'created ASC',
                  //'limit' => $count,
                  //'offset' => ($page-1)*$count,
          ));
	    if (isset($condition['max_id'])) {
            $criteria->addCondition("message_id <= ".$condition['max_id'], 'AND');
        }
        if (isset($condition['since_id'])) {
            $criteria->addCondition("message_id >= ".$condition['since_id'], 'AND');
        }
	   $objData = $objMessages->findAll($criteria);
		
		if (empty($objData)) {
            $arrayData = array();
        }else{
        	
			$id_user = Yii::app()->user->id;
			foreach($objData as $value) {
				$han = $value->getAttributes();
				$han['realtime'] = date("h:i:s",$han['created']);
				if($han['sender_id']==$id_user)
					{$han['senderClass']="me";}
					else
					{$han['senderClass']="others";}
					
					$objUser = new Users;
					$userData = $objUser->findByPk($han['sender_id']);
					$UserArray = $userData->getAttributes();
					$han['avatar']=$UserArray['avatar'];
						
				$arrayData[] = $han;
        	}
        }
		return array(
			'data' => $arrayData,
			);		
	}

    public static function getLastMessageContent($message_group_id)
    {
		$objMessages = new Messages();
  		if ( empty($message_group_id) ) {
            return false;
        }
        //获取数据
  		$criteria = new CDbCriteria(array(
				  'condition' => 'message_group_id = '.$message_group_id .' and 1=1',
                  'order' => 'created DESC',
                  'limit' => '1',
          ));
	   $objData = $objMessages->find($criteria);
		if (empty($objData)) {
            $data = array();
        }else{
			$data = $objData->getAttributes();
        }
		return $data;
	}
		
	public static function getGroupMembers($message_group_id)
	{
				if ( empty($message_group_id) ) {
            return false;
        }
		$objMessageGroupMembers = new MessageGroupMembers();
		$criteria = new CDbCriteria(array(
				  'condition' => 'message_group_id = '.$message_group_id,
                  'order' => 'user_id ASC',
          ));
		  
	
		$objResult = $objMessageGroupMembers->findAll($criteria);

	
		if (!empty($objResult)) {
        	
			$arrayData = array();
				foreach($objResult as $value) {
					$arrayAttr = $value->getAttributes();
					$arrayData[] = $arrayAttr["user_id"];
				}
				return $arrayData;
			
		}
	
	}
		
}

?>