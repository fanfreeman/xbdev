<?php

class ImController extends Controller
{	
	public $layout='//layouts/Im';
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
		{
			return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
					'actions'=>array('LoadListChater','LoadCreatMessage_group','LoadWindowsChater','SendMessage','GetNoreadMessage','GetAddFriendList','Create_Message_Group'),
					'users'=>array('@'),
				),
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
		}
	
	public function actionLoadListChater()
	{
		$listchater = Im::getListChater();
		$this->renderPartial('listchater',$listchater);	
	}
	
	public function actionLoadCreatMessage_group($id_chater)
	{   
		$callback = MessageGroups::LoadCreatMessage_group($id_chater);
		echo json_encode($callback);
	}
	
	public function actionLoadWindowsChater($message_group_id)
	{
		$id_user = Yii::app()->user->id;
		$objMessagegroupmember = new MessageGroupMembers();
		$objData = $objMessagegroupmember->find("message_group_id='$message_group_id' and user_id = '$id_user'");
		$other_members = $objData->other_members;
		//用户名显示
		$array_members =explode("_",$other_members);
		$array_member_names = array();
		foreach($array_members as $user_id)
		{
			$model_user = AtomUsers::model()->findByPk($user_id);
			$array_member_names[]= CHtml::encode($model_user->firstname).'&nbsp;'.CHtml::encode($model_user->lastname);
		}	
		$str_users_name  = implode(',',$array_member_names);
		
		//读取信息列表
		$modelMessages = new Messages();
		$modelMessages->message_group_id = $message_group_id;
		$dataMessages = $modelMessages->get_format_messages('0');

		 //标记为已读
		 //如果该用户的读取信息最后一条和当前刷新的last_id不统一
		 if (count($dataMessages)>0)
		 {
			$last_message_id = $dataMessages[count($dataMessages)-1]['message_id'];
			if($objData->last_message_id!=$last_message_id)
			{
				$modelMessagegroupmember = new MessageGroupMembers();
				$modelMessagegroupmember->message_group_id = $message_group_id;
				$modelMessagegroupmember->user_id = $id_user;
				$modelMessagegroupmember->update_last_message_id($last_message_id);
			}
		 }
		$callback['success'] = true;	
		$callback['html'] = $this->renderPartial('chatwindow',array('message_group_id'=>$message_group_id,'str_users_name'=>$str_users_name,"dataMessages"=>$dataMessages),true);
		echo json_encode($callback);	
		
	}
	
	function actionSendMessage()
    { //一会要测试一下发送失败的情况
		$id_user = Yii::app()->user->id;
		$type='1';
		$objMessage = new Messages();
        $objMessage->sender_id = $id_user;
		$objMessage->type = $type;
        $objMessage->message_group_id = $_POST['message_group_id'];
        $objMessage->message = $_POST['message_sended'];
        $objMessage->created = time();
		if($new_message = $objMessage->sendMessage())
		{
		$callback['success'] = true;	
		
		$data_message = $new_message->getAttributes();
		$data_message['avatar'] = $new_message->sender->avatar;
		$data_message['sender_firstname'] = $new_message->sender->firstname;
		$data_message['realtime'] = date("h:i:s",$data_message['created']);
		$dataMessages = array($data_message);
		$callback['html'] = $this->renderPartial('messages',array('dataMessages'=>$dataMessages),true);
		}
		else
		{
		$callback['success'] = false;
		$callback['error'] = "fall to send message";	
		}
		echo json_encode($callback);	
	}
	
	function actionGetNoreadMessage($message_group_id,$last_message_id)
	{
		//读取信息列表
		$modelMessages = new Messages();
		$modelMessages->message_group_id = $message_group_id;
		$dataMessages = $modelMessages->get_format_messages($last_message_id);
		//标记为已读
		if (count($dataMessages)>0)
		 {
			$update_message_id = $dataMessages[count($dataMessages)-1]['message_id'];
			//if(isset($temp['message_id'])&&$last_message_id!=$temp['message_id'])
			{
				$modelMessagegroupmember = new MessageGroupMembers();
				$modelMessagegroupmember->message_group_id = $message_group_id;
				$id_user = Yii::app()->user->id;
				$modelMessagegroupmember->user_id = $id_user;
				$modelMessagegroupmember->update_last_message_id($update_message_id);
			}
			$callback['html'] = $this->renderPartial('messages',array('dataMessages'=>$dataMessages),true);
		}
		else
		{
			$callback['html'] = '';	
		}	
		$callback['success'] = true;
		echo json_encode($callback);	
	}
	
	function actionGetAddFriendList($str_search,$message_group_id)
	{
		
		$str_search = trim($str_search);
		$listchater = false;
		if ($str_search) {
			$listchater = MessageGroupMembers::GetAddFriendList($str_search,$message_group_id);
		}
		
		$callback['success'] = true;
		if($listchater)
		{
			$callback['html'] = $this->renderPartial('listaddusers',array('listchater'=>$listchater),true);
		}
		else
		{
			$callback['html']='';
		}
		echo json_encode($callback);		
		
		//echo  "{\"listchater\":".json_encode($listchater)."}";
	}
	
	function actionCreate_Message_Group($message_group_id,$friend_id)
	{
		
		$id_user = Yii::app()->user->id;
		$objMessagegroupmember = new MessageGroupMembers();
		$objData = $objMessagegroupmember->find("message_group_id='$message_group_id' and user_id = '$id_user'");
		$other_members = $objData->other_members;
		$str_friends =  $friend_id.'_'.$other_members;
		$array_members =explode("_",$str_friends);
		$array_members = array_filter(array_unique($array_members));
		sort($array_members);
		$all_members = implode("_",$array_members);
		
		$callback_message_group = MessageGroups::LoadCreatMessage_group($all_members);
		$message_group_id = $callback_message_group['message_group_id'];
		$callback['success'] = true;
		$callback['message_group_id'] = $message_group_id;
		echo json_encode($callback);	
	}
}