<?php
class bizMessage
{
	public static function showMessageGroupList($array_user)
    {
		//人搜索，就是做交集 pe vc
		//$array_user = array('2');
		$user_id = Yii::app()->user->id;
		$objMessageGroupMembers = new MessageArchive();	 
		 if  (count($array_user)>0)
		 {
			$str_sql = '';
			foreach($array_user as $key=>$user)
			{
				if ($key=='0')
				{
					$str_sql .=  '((sender_id = '.$user_id.' and reciver_id = '.$user['user_id'].') or (sender_id = '.$user['user_id'].' and reciver_id = '.$user_id.'))';
				}
				else
				{
					$str_sql .=  ' or ((sender_id = '.$user_id.' and reciver_id = '.$user['user_id'].') or (sender_id = '.$user['user_id'].' and reciver_id = '.$user_id.'))';
				}
			}	
			$criteria = new CDbCriteria(array(
				 // 'condition' => '(sender_id = '.$user_id.' and reciver_id = '.$array_user[0]['user_id'].') or (sender_id = '.$array_user[0]['user_id'].' and reciver_id = '.$user_id.') ',
				 'condition' => $str_sql,
				  'group' => 'all_members',
                 // 'order' => 'user_id ASC',
          ));
		  }
		  else
		  {
			$criteria = new CDbCriteria(array(
				  'condition' => '(sender_id = '.$user_id.' or reciver_id = '.$user_id.')',
				  'group' => 'all_members',
                 // 'order' => 'user_id ASC',
          )); 
		}
		$objResult = $objMessageGroupMembers->findAll($criteria);
		$count_all = $objMessageGroupMembers->count($criteria);
		if (!empty($objResult)) {
			$arrayData = array();
			$arrayData['sum'] = $count_all;
				foreach($objResult as $value) 
				{
					$arrayAttr = $value->getAttributes();
					$arrayAttr['array_other_members'] = bizMessage::getOtherMembers($arrayAttr['all_members']);
					$arrayAttr['users_name'] = bizMessage::show_users_name($arrayAttr['array_other_members']);
					$arrayAttr['last_message'] = bizMessage::getLastMessageByMembers($arrayAttr['all_members']);
					$arrayData['data'][] = $arrayAttr;
				}
				return $arrayData;
		}
	}

	public static function addNewMessageGroup($all_members)
    {
		//人搜索，就是做交集 pe vc
		//$array_user = array('2');
		$user_id = Yii::app()->user->id;
		$objMessageGroupMembers = new MessageArchive();	 
					$criteria = new CDbCriteria(array(
				  'condition' => 'sender_id = '.$user_id.' and all_members = \''.$all_members.'\'',
                  'group' => 'all_members',
				 // 'order' => 'user_id ASC',
          )); 
		$objResult = $objMessageGroupMembers->findAll($criteria);
		$count_all = $objMessageGroupMembers->count($criteria);
		if (!empty($objResult)) {
			$arrayData = array();
			$arrayData['sum'] = $count_all;
				foreach($objResult as $value) 
				{
					$arrayAttr = $value->getAttributes();
					$arrayAttr['array_other_members'] = bizMessage::getOtherMembers($arrayAttr['all_members']);
					$arrayAttr['users_name'] = bizMessage::show_users_name($arrayAttr['array_other_members']);
					$arrayAttr['last_message'] = bizMessage::getLastMessageByMembers($arrayAttr['all_members']);
					$arrayData['data'][] = $arrayAttr;
				}
				return $arrayData;
		}
	}
	
	public static function reciveNewMessageGroup($all_members)
    {
		//人搜索，就是做交集 pe vc
		//$array_user = array('2');
		$user_id = Yii::app()->user->id;
		$objMessageGroupMembers = new MessageArchive();	 
					$criteria = new CDbCriteria(array(
				  'condition' => 'reciver_id = '.$user_id.' and all_members = \''.$all_members.'\'',
                  'group' => 'all_members',
				 // 'order' => 'user_id ASC',
          )); 
		$objResult = $objMessageGroupMembers->findAll($criteria);
		$count_all = $objMessageGroupMembers->count($criteria);
		if (!empty($objResult)) {
			$arrayData = array();
			$arrayData['sum'] = $count_all;
				foreach($objResult as $value) 
				{
					$arrayAttr = $value->getAttributes();
					$arrayAttr['array_other_members'] = bizMessage::getOtherMembers($arrayAttr['all_members']);
					$arrayAttr['users_name'] = bizMessage::show_users_name($arrayAttr['array_other_members']);
					$arrayAttr['last_message'] = bizMessage::getLastMessageByMembers($arrayAttr['all_members']);
					$arrayData['data'][] = $arrayAttr;
				}
				return $arrayData;
		}
	}	

	public static function show_users_name($array_members)
		{
			foreach($array_members as $user_id)
			{
				$array_temp['user_id'] = $user_id;
				$members = bizUser::getInfo($array_temp);
				$array_member_names[]= $members['firstname'].'&nbsp;'.$members['lastname'];
				//$array_member_names[]= "<a href=\"index.php?r=Profile/Index&uid=$user_id\" target=\"_blank\">".$members['firstname'].'&nbsp;'.$members['lastname']."</a>";
				}	
			return  implode(',',$array_member_names);
		}
		
	public static function getLastMessageByMembers($all_members)
		{
			$objMessageArchive = new Messages();			
			$criteria = new CDbCriteria(array(
				  'condition' => 'message_archive.all_members = \''.$all_members.'\'',
				  'join' =>'LEFT JOIN message_archive ON t.message_id = message_archive.message_id',
				  'order' => 't.message_id DESC',
          	));
			$objResult = $objMessageArchive->find($criteria);
			if (!empty($objResult)) {
				 $arrayAttr = $objResult->getAttributes();
				 return $arrayAttr;
			}
		}
	
	public static function getOtherMembers($all_members)
		{
			$user_id = Yii::app()->user->id;
			$array_members =explode("_",$all_members);
			foreach($array_members as $key=>$intUserId)
			{
				if ($user_id==$intUserId)
				{unset($array_members[$key]);}
			}
			$array_members = array_filter(array_unique($array_members));
			sort($array_members);
			return $array_members;
		}
		
	public static function makeAllMembers($user_id,$other_members)
		{
			$array_other_members = explode("_",$other_members);	
			array_push($array_other_members,$user_id);
			$array_other_members = array_filter(array_unique($array_other_members));
			sort($array_other_members);
			return $array_other_members;
		}					

	public static function get_arrayusers_name($array_members)
		{
			foreach($array_members as $user_id)
			{
				$array_temp['user_id'] = $user_id;
				$members = bizUser::getInfo($array_temp);
				$array_temp['user_name'] = $members['firstname'].'&nbsp;'.$members['lastname'];
				$array_member_info[]= $array_temp;
				}	
			return  $array_member_info;
		}
			
	public static function getUserIdByname($str_search)
		{
			$user_id = array(Yii::app()->user->id);
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
			$criteria->addNotInCondition('user_id', $user_id);
			$objUsers = new Users;
			$objData = $objUsers->findAll($criteria);
			if (empty($objData)){ return false;}
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
		
	public static function loadMessagesByAll_members($all_members)
	{
		$user_id = Yii::app()->user->id;
		$objMessageArchive = new Messages();
		$criteria = new CDbCriteria(array(
				 // 'condition' => "t.all_members = '".$all_members."' and (t.sender_id ='".$user_id."' or t.reciver_id = '".$user_id."')",
				  //'join' =>'LEFT JOIN messages ON t.message_id = messages.message_id',
				  //'group' => 't.message_id',
                  //'order' => 'created ASC',
				   'condition' => 'message_archive.all_members = \''.$all_members.'\' and (message_archive.sender_id =\''.$user_id.'\' or message_archive.reciver_id = \''.$user_id.'\')',
				  'join' =>'LEFT JOIN message_archive ON t.message_id = message_archive.message_id',
				  'group' => 'message_archive.message_id',
          ));
		$objResult = $objMessageArchive->findAll($criteria);
		if (!empty($objResult)) {
			$arrayData = array();
				foreach($objResult as $value) 
				{
					$arrayAttr = $value->getAttributes();
					if($arrayAttr['sender_id']==$user_id)
					{$arrayAttr['senderClass']="me";}
					else
					{$arrayAttr['senderClass']="others";}
					$arrayAttr['realtime'] = date("h:i:s",$arrayAttr['created']);
					
					$objUser = new Users;
					$userData = $objUser->findByPk($arrayAttr['sender_id']);
					$UserArray = $userData->getAttributes();
					$arrayAttr['avatar']=$UserArray['avatar'];
		
					$arrayData[] = $arrayAttr;
				}
				return $arrayData;
		} 
	}	
	
	//////发消息功能
	
	//////发消息功能结束	
	
    public static function GetAddFriendList($str_search,$str_has_id)
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
		 if ($str_has_id!='')
		 {
				$array_users= explode("_",$str_has_id);
				foreach($array_users as $user_id)
				{
					array_push($arrayAttrUsers,$user_id);
				}
	      }
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
}
?>