<?php
class bizMessageArchive
{

public static function send_message_archive($message_id,$message_group_id,$sender_id,$created)
		{
			$all_members = bizMessages::getGroupMembers($message_group_id);
			$str_all_members = implode('_',$all_members);
			//return($str_all_members);			
			foreach($all_members as $user_id) 
				{
					if ($user_id!=$sender_id)
					{
						$objMessageArchive = new MessageArchive();
						$objMessageArchive->message_id = $message_id;
						$objMessageArchive->sender_id = $sender_id;
						$objMessageArchive->reciver_id = $user_id;
						$objMessageArchive->all_members = $str_all_members;
						$objMessageArchive->created = $created;
						if (!$objMessageArchive->save()) {
							return false;
						}
					}
				}
				
		}

public static function get_message_archive($message_group_id)
		{
			$all_members = bizMessages::getGroupMembers($message_group_id);
			$str_all_members = implode('_',$all_members);
			
			$user_id = Yii::app()->user->id;
			$objMessageArchive = new MessageArchive();
			$objData = $objMessageArchive->findAll("(sender_id='".$user_id."' or reciver_id ='".$user_id."') and all_members ='".$str_all_members."'");
			if (!$objData)
			{return false;}
			
			$pre_message = "";
			foreach($objData as $value) {
				$temp = $value->getAttributes();	
				
				$temp['show_type'] = bizMessageArchive::check_message_show_type($pre_message,$temp);
				$pre_message = $temp;
				$temp['realtime'] = date("h:i:s",$temp['created']);
				
				$objMessages = new Messages();
				$objResult = $objMessages->find('message_id='.$temp["message_id"]);
					 $arrayAttr = $objResult->getAttributes();
					 $temp['message'] =  $arrayAttr['message'];
					 $temp['type'] =  $arrayAttr['type'];
				$arrayData[] =$temp;			
			}
			return $arrayData;
		}	
		
public static function check_message_show_type($pre_message,$message)
	{	if ($pre_message=="")
		return "2";
		if(($pre_message['sender_id']==$message['sender_id'])&&($message['created']-$pre_message['created']<10))
		{return "1";}
		else
		{return "2";}
	}
}

?>