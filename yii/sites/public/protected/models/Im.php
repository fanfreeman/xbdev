<?php
/**
* 
*/
class Im
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
			$id_user = Yii::app()->user->id;
		 	$criteria = new CDbCriteria(array(
						'condition' => 'user_id  != '.$id_user,
						'order' => 'created ASC',
			));
			$objuser = new AtomUsers();
			$intTotal = $objuser->count($criteria);
			$objData = $objuser->findAll($criteria);
		
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
}