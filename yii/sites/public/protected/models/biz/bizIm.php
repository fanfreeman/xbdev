<?php
/**
* 
*/

class bizIm
{
	    /**
     * 获取聊天者用户列表
     * $return array(
     *      'data' => $arrayData, // 返回users列表的数组
     *      'total' => $intTotal, // 返回users聊天者总记录数
     * );
     */
    public static function getListChater()
   		{
		 $user_id = Yii::app()->user->id;
		 $criteria = new CDbCriteria(array(
						'condition' => 'user_id  != '.$user_id,
						'order' => 'created ASC',
						//'limit' => $intCount,
						//'offset' => ($intPage-1)*$intCount,
				));
				
				$objDirectory = new Users;
				$intTotal = $objDirectory->count($criteria);
				$objData = $objDirectory->findAll($criteria);
		
				$arrayData = array();
				foreach($objData as $value) {
					$arrayAttr = $value->getAttributes();
					$arrayData[] = $arrayAttr;
				}
				return array(
					'data' => $arrayData,
					'total' => $intTotal,
				);
		}

    public static function countListChater()
   		{
		 $user_id = Yii::app()->user->id;
		 $criteria = new CDbCriteria(array(
						'condition' => 'user_id  != '.$user_id,
						'order' => 'created ASC',
						//'limit' => $intCount,
						//'offset' => ($intPage-1)*$intCount,
				));
				
				$objDirectory = new Users;
				$intTotal = $objDirectory->count($criteria);
		
	
				return $intTotal;
		}
		
    public static function GetAddFriendList($str_search,$message_group_id)
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
		$criteriaUser = new CDbCriteria(array(
						'condition' => "message_group_id = ".$message_group_id,
				));
		$message_group = new MessageGroupMembers;
		$objDataUsers = $message_group->findAll($criteriaUser);	
		
		$arrayAttrUsers = array();
		foreach($objDataUsers as $user)
		{
		$arrayAttrUser = $user->getAttributes();
		$arrayAttrUsers[] = $arrayAttrUser["user_id"];
		}
				//return $arrayAttrUsers ;exit;
		 $user_id = Yii::app()->user->id;
		 
		 //
		 $array_str_search =explode(" ",$str_search);
		 if (count($array_str_search)==2)
		 {
			$criteria = new CDbCriteria(array(
							'condition' => "(firstname like '".$array_str_search[0]."%' and lastname like '".$array_str_search[1]."%')",
							'order' => 'created ASC',
					));	 
		 }
		 else
		 {
			 $criteria = new CDbCriteria(array(
							'condition' => "(firstname like '".$str_search."%' or lastname like '".$str_search."%')",
							'order' => 'created ASC',
					));
		 }
				$criteria->addNotInCondition('user_id', $arrayAttrUsers);
				
				$objDirectory = new Users;
				$objData = $objDirectory->findAll($criteria);
		
				$arrayData = array();
				foreach($objData as $value) {
					$arrayAttr = $value->getAttributes();
					$temp['user_id'] = $arrayAttr['user_id'];
					$temp['firstname'] = $arrayAttr['firstname'];
					$temp['lastname'] = $arrayAttr['lastname'];
					$arrayData[]= $temp;
			
				}
				return $arrayData;
		}
		
	public static function CreatMessage_group($id_chater)
		{
			if (empty($id_chater)) {
            return false;
        	}
			$user_id = Yii::app()->user->id;
			$objModel = new MessageGroupMembers();
			$objResult = $objModel->find("user_id=".$user_id." and other_members='$id_chater'  order BY message_group_id DESC");
			if (!empty($objResult)) {
				 $arrayAttr = $objResult->getAttributes();
				 return $arrayAttr["message_group_id"];
			}
			
			$objMessageGroups = new MessageGroups();
			$objMessageGroups->created = time();
			if (!($objMessageGroups->save())) {
				return false;
			}
			$message_group_id = $objMessageGroups["message_group_id"];
			
			$str_array_members = $user_id."_".$id_chater;
			$array_members =explode("_",$str_array_members);
			foreach ($array_members as $key=>$intUserId)
			{
				$arrat_temp = $array_members;
				unset($arrat_temp[$key]);
				$arrat_temp = array_filter(array_unique($arrat_temp));
				sort($arrat_temp);
				$other_members = implode('_',$arrat_temp);	
				$objMessageGroupMembers = new MessageGroupMembers(); 
				$objMessageGroupMembers->message_group_id = $message_group_id;
            	$objMessageGroupMembers->user_id = $intUserId;
				$objMessageGroupMembers->other_members = $other_members;
				$objMessageGroupMembers->save();
			}
			return $message_group_id;
		}
		
		public static function getGroup_other_members($message_group_id)
		{
			$user_id = Yii::app()->user->id;
			$objModel = new MessageGroupMembers();
			$objResult = $objModel->find("user_id = $user_id and message_group_id= $message_group_id");
				if (!empty($objResult)) {
					 $arrayAttr = $objResult->getAttributes();
					 return $arrayAttr["other_members"];
				}
				return false;
		}
		
		//将发送消息用户的message_group_members表内的last_message_id标记为刚刚发送的mwssage_id
		public static function update_last_message_id($last_message_id,$message_group_id,$user_id)
		{
			$objMessagegroupmembers = new MessageGroupMembers();
			$objData = $objMessagegroupmembers->find('message_group_id='.$message_group_id." and user_id = ".$user_id);
			$arrayData[] = $objData->getAttributes();
			$objMessagegroupmembers->updateByPk($arrayData[0]["message_group_member_id"], array('last_message_id'=>$last_message_id));
		}

	//将对话内除发送者其余用户的message_group_member内的al_read改为0
		//------------注意，现在没有做数组遍历，仅仅支持2个用户交流
		public static function send_last_message_id($last_message_id,$message_group_id,$user_id)
		{
			$objMessagegroupmembers = new MessageGroupMembers();
			$objData = $objMessagegroupmembers->findAll('message_group_id='.$message_group_id." and user_id != ".$user_id." and last_message_id !=".$last_message_id);
			//$objData = $objMessagegroupmembers->findAll('message_group_id='.$message_group_id." and last_message_id !=".$last_message_id);
			
			foreach($objData as $value) {
        		$arrayData = array();
				$arrayData = $value->getAttributes();
        		$objMessagegroupmembers->updateByPk($arrayData["message_group_member_id"], array('is_read'=>"0"));	
			
			}
			//$arrayData[] = $objData->getAttributes();
				
		}	
		
		public static function update_NGuser_last_M_id($message_group_id,$new_group_members,$message_id)
		{
		
			foreach($new_group_members as $user_id)
			{
				
				//$objMessagegroupmembers = array();
				$objMessagegroupmembers = new MessageGroupMembers();
				$objData = $objMessagegroupmembers->find('message_group_id='.$message_group_id." and user_id = ".$user_id);
				$arrayData = $objData->getAttributes();
				$objMessagegroupmembers->updateByPk($arrayData["message_group_member_id"], array('last_message_id'=>($message_id-1)));
			}
		}	
////////

/*
    public static function createSession($chat_session)
    {
		$arrayMemberIds =explode("_",$chat_session);
        foreach ($arrayMemberIds as $intUserId) {
			$objMember = new MessageGroupMembers(); 
            $objMember->message_group_id = $message_group_id;
            $objMember->user_id = $intUserId;
            //$objMember->is_left = "1";echo "dddd";exit;
			$objMember->save();
        }

        return $message_group_id;
    }	
	*/	
	
		public static function checkMessage($user_id)
		{
		$objMessagegroupmembers = new MessageGroupMembers();
		//
		$objUsers = new Users();
		$objUserData = $objUsers->findByPk($user_id);
		//$arrayData = $objUserData->getAttributes();
		$objUserData->updateByPk($user_id, array('ping'=>time()));
		//
		
		$objData = $objMessagegroupmembers->find("is_read = 0 and user_id = ".$user_id);
		if ($objData)
		{
		$arrayData[] = $objData->getAttributes();
		//计算对话的真实session
		/*
		foreach($arrayData as $key => $value)
		{
			$arrat_group = bizMessages::getMessagegroupmembersByGroup($value["message_group_id"]);
			
			//$arrat_group = array_filter(array_unique($arrat_group));
			//sort($arrat_group);

			//$strKeys = implode('',$arrat_group);		
			$strKeys = bizIm::creat_session_chat($arrat_group);
			$arrayData[$key]["chat_session"]=$strKeys;
			
			foreach($arrat_group as $val)
			{
				if ($val != $user_id)
				{
					$arrayData[$key]["other_chater"] = $val;
					}
				}
			
			
			}
			*/
		return($arrayData);
		}
		else
		{return false;}
	}
	
	public static function checkOnline($user_id)
	{
		$objUsers = new Users();
			$objData = $objUsers->findAll("user_id !='$user_id'");
			$str_time = time();
			$arrat_online = array();
			foreach($objData as $value) {
				$arrayData = $value->getAttributes();
				$temp['user_id'] = $arrayData['user_id'];
				if  (isset($arrayData['ping'])&&($str_time-$arrayData['ping']<3))
				{
				$temp['online'] = '1';
				}
				else
				{
				$temp['online'] = '0';
				}
				$arrat_online[] = $temp;
			}
			return $arrat_online;
			
	}		
		public static function read_last_message_id($last_message_id,$message_group_id,$user_id)
	{
		$objMessagegroupmembers = new MessageGroupMembers();
		$objData = $objMessagegroupmembers->find('message_group_id='.$message_group_id." and user_id = ".$user_id);
		$arrayData[] = $objData->getAttributes();
		$objMessagegroupmembers->updateByPk($arrayData[0]["message_group_member_id"], array('last_message_id'=>$last_message_id,'is_read'=>"1"));		
		}
		
		public static function update_Message_group($message_group_id,$old_group_members,$new_group_members,$group_members)
		{
			foreach($group_members as $key=>$user_id)
			{	
				$arrat_temp = $group_members;
				unset($arrat_temp[$key]);
				$arrat_temp = array_filter(array_unique($arrat_temp));
				$other_members = implode('_',$arrat_temp);	
				
				if(in_array($user_id,$old_group_members))
				{
					 //echo "update";
				$objMessagegroupmembers = new MessageGroupMembers();
				$objData = $objMessagegroupmembers->find('message_group_id='.$message_group_id." and user_id = ".$user_id);
				$arrayData = array();
				$arrayData[] = $objData->getAttributes();
				$objMessagegroupmembers->updateByPk($arrayData[0]["message_group_member_id"], array('other_members'=>$other_members));	
				}
				else
				{
					//echo "insert";
				
				$objMessageGroupMembers = new MessageGroupMembers(); 
				$objMessageGroupMembers->message_group_id = $message_group_id;
            	$objMessageGroupMembers->user_id = $user_id;
				$objMessageGroupMembers->other_members = $other_members;
				$objMessageGroupMembers->save();
				}
			}
		}
		
	public static function LeaveChatGroup($message_group_id)
	{
		$old_group_members = bizMessages::getGroupMembers($message_group_id);
		$user_id = Yii::app()->user->id;
		unset($old_group_members[array_search($user_id,$old_group_members)]);
		
		$objMessagegroupmember = new MessageGroupMembers();
		 $objMessagegroupmember->deleteAll("message_group_id = :message_group_id and user_id = :user_id ", array(
			':message_group_id'=>$message_group_id,
			':user_id'=>$user_id,
			));
		
		foreach($old_group_members as $key=>$group_member)
		{
			$arrat_temp = $old_group_members;
			unset($arrat_temp[$key]);
			$arrat_temp = array_filter(array_unique($arrat_temp));
			$other_members = implode('_',$arrat_temp);
			$objMessagegroupmembers = new MessageGroupMembers();
			$objData = $objMessagegroupmembers->find('message_group_id='.$message_group_id." and user_id = ".$group_member);
			$arrayData = array();
			$arrayData[] = $objData->getAttributes();
			$objMessagegroupmembers->updateByPk($arrayData[0]["message_group_member_id"], array('other_members'=>$other_members));		
		}
		return $old_group_members;
	}
		
	public static function show_users_name($other_members)
	{
		$array_members =explode("_",$other_members);
		$array_member_names = array();
		foreach($array_members as $user_id)
		{
			$array_temp['user_id'] = $user_id;
			$members = bizUser::getInfo($array_temp);
			$array_member_names[]= $members['firstname'].'&nbsp;'.$members['lastname'];
			//$array_member_names[]= "<a href=\"index.php?r=Profile/Index&uid=$user_id\" target=\"_blank\">".$members['firstname'].'&nbsp;'.$members['lastname']."</a>";

		}	
		return  implode(',',$array_member_names);
	}	
}