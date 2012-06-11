<?php

class MessageController extends Controller
{	
	public $layout='//layouts/atom';
	
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
					'actions'=>array('index','indexajax','CreatMessages','LoadNewMessageGroup','loadMessages','SendMessage','SendNewMessage','GetAddFriendList','LoadCheckMessage','GetNoreadMessage','refreshMessageGroupList'),
					'users'=>array('@'),
				),
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
		}
	
	public function actionIndex()
	{
		$user_id = Yii::app()->user->id;
		$modeltest = MessageGroupMembers::model()->findAll(
			array(
				'condition'=>"user_id = '$user_id'", 
				'order'=>'t.last_message_id DESC',
					));
		$datatest = array();	
			foreach($modeltest as $message_group_member)
			{
				$temp = $message_group_member->getAttributes();
				//$temp['lastMessage'] = $message_group_member->lastMessage->getAttributes();
				if ($temp['last_message_id'])
					{
						if($model_message = Messages::model()->findByPk($temp['last_message_id']))
						{
							$temp['lastMessage'] = $model_message->getAttributes();
						}
						else
						{
							$temp['lastMessage']['message']='';
						}
					}
				else{$temp['lastMessage']['message']='';}	
				$temp['messageGroup'] = $message_group_member->messageGroup->getAttributes();
				$data_other_members = Messages::get_userinfo_by_ids($temp['other_members']);
				if (count($data_other_members)>1)
				{$temp['avatar']='/images/peoplegroup.png';}
				else
				{	if(isset($data_other_members[0]))
					{ 
						$temp['avatar']= $data_other_members[0]['avatar'];
					}
					else
					{
						$temp['avatar']= '/images/peoplePic03.png';
					}
				}
				
				$temp['array_name_other_members'] = array();
				foreach ($data_other_members as $data_other_member)
					{
						array_push($temp['array_name_other_members'],CHtml::encode($data_other_member['firstname']).' '.CHtml::encode($data_other_member['lastname']));
					}
				$datatest[] = $temp;
			}
		$this->render('index',array('datatest'=>$datatest));
	}

	public function actionIndexajax()
		{
			$user_id = Yii::app()->user->id;
			$modeltest = MessageGroupMembers::model()->findAll(
				array(
					'condition'=>"user_id = '$user_id'", 
					'order'=>'t.last_message_id DESC',
						));
			$datatest = array();	
				foreach($modeltest as $message_group_member)
				{
					$temp = $message_group_member->getAttributes();
					//$temp['lastMessage'] = $message_group_member->lastMessage->getAttributes();
					if ($temp['last_message_id'])
						{
							$model_message = Messages::model()->findByPk($temp['last_message_id']);
							$temp['lastMessage'] = $model_message->getAttributes();
						}
					else{$temp['lastMessage']['message']='';}	
					$temp['messageGroup'] = $message_group_member->messageGroup->getAttributes();
					$data_other_members = Messages::get_userinfo_by_ids($temp['other_members']);
					if (count($data_other_members)>1)
					{$temp['avatar']='/images/peoplegroup.png';}
					else
					{$temp['avatar']= $data_other_members[0]['avatar'];}
					
					$temp['array_name_other_members'] = array();
					foreach ($data_other_members as $data_other_member)
						{
							array_push($temp['array_name_other_members'],CHtml::encode($data_other_member['firstname']).' '.CHtml::encode($data_other_member['lastname']));
						}
					$datatest[] = $temp;
				}
			$callback['success'] = true;
			$callback['html'] = $this->renderPartial('index',array('datatest'=>$datatest),true);
			echo json_encode($callback);	
		}
	
	public function actionLoadNewMessageGroup($message_group_id)
	{
		$user_id = Yii::app()->user->id;
		$modeltest = MessageGroupMembers::model()->find("message_group_id = '$message_group_id' and user_id = '$user_id'");
		$datatest = array();	
				$temp = $modeltest->getAttributes();
				//gaigaigaigiagai
				if ($temp['last_message_id'])
					{
						$model_message = Messages::model()->findByPk($temp['last_message_id']);
						$temp['lastMessage'] = $model_message->getAttributes();
					}
				else{$temp['lastMessage']['message']='';}
				$temp['messageGroup'] = $modeltest->messageGroup->getAttributes();
				$data_other_members = Messages::get_userinfo_by_ids($temp['other_members']);
				
				if (count($data_other_members)>1)
				{$temp['avatar']='/images/peoplegroup.png';}
				else
				{$temp['avatar']= $data_other_members[0]['avatar'];}
				
				$temp['array_name_other_members'] = array();
				foreach ($data_other_members as $data_other_member)
					{
						$temp_str_name = CHtml::encode($data_other_member['firstname'].' '.$data_other_member['lastname']);
						array_push($temp['array_name_other_members'],$temp_str_name);
					}
				$datatest[] = $temp;
		$callback['success'] = true;	
		$callback['html'] = $this->renderPartial('listgroup',array('datatest'=>$datatest),true);
		echo json_encode($callback);	
	}
	
	function actionCreatMessages()
    {	
		$callback['success'] = true;	
		$callback['html'] =  $this->renderPartial('newinformationrecord','',true);
		echo json_encode($callback);	
    }
		
	function actionloadMessages($all_members,$other_members,$message_group_id,$last_message_id)
    {	
	   $id_user = Yii::app()->user->id;
	   $modelMessages = Messages::model()->findAll(
			array('condition'=>"message_group_id = '$message_group_id'", 
					'order'=>'t.created ASC',
					));
		$dataMessages = array();	
		$temp;
		if ($modelMessages)
		{
			foreach($modelMessages as $message)
			{
				$temp = $message->getAttributes();
				($message['sender_id']==$id_user)?$temp['senderClass']='me':$temp['senderClass']='others';
				$temp['realtime'] = date("h:i:s",$message['created']);
				$temp['firstname'] = $message->sender->firstname;
				$temp['lastname'] = $message->sender->lastname;
				$temp['avatar'] = $message->sender->avatar;
				$dataMessages[] = $temp;
			}
		//如果该用户的读取信息最后一条和当前刷新的last_id不统一
		//if(isset($temp['message_id'])&&$last_message_id!=$temp['message_id'])
			{
				//update late_message_id and is_read=1
				$objMessagegroupmember = new MessageGroupMembers();
				$objData = $objMessagegroupmember->find("message_group_id='$message_group_id' and user_id = '$id_user'");
				$Data = $objData->getAttributes();
				$objMessagegroupmember->updateByPk($Data["message_group_member_id"], array('last_message_id'=>$temp['message_id'],'is_read'=>'1'));   
			}	
		 }
		$data_other_members = Messages::get_userinfo_by_ids($other_members);
		//print_r($data_other_members);
		
		$callback['success'] = true;	
		$callback['html'] = $this->renderPartial('informationrecord',array('message_group_id'=>$message_group_id,'all_members'=>$all_members,'other_members'=>$other_members,'data_other_members'=>$data_other_members,'dataMessages'=>$dataMessages),true);
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
		if(!$objMessage->sendMessage())
		{
			$callback['success'] = false;
			$callback['error'] = 'cant send message';		
		}
		else
		{
			$callback['success'] = true;
			$message = $objMessage->getAttributes();
			$message['senderClass']='me';
			$message['realtime']=date("h:i:s",$message['created']);
			$message['firstname'] = $objMessage->sender->firstname;
			$message['lastname'] = $objMessage->sender->lastname;
			$message['avatar'] = $objMessage->sender->avatar;
			$data = array();
			$data[] = $message;
			$callback['html'] = $this->renderPartial('messages',array('data' =>$data),true);
			$callback['last_message_sended'] = CHtml::encode($_POST['message_sended']);
		}
		echo json_encode($callback);	
	}
	
	function actionSendNewMessage()
    {	
		
		$str_otherMembers = $_POST["str_otherMembers"];
		$array_otherMembers =explode("_",$str_otherMembers);
		$user_id = Yii::app()->user->id;
		array_push($array_otherMembers,$user_id);
		$array_all_members = array_filter(array_unique($array_otherMembers));
		sort($array_all_members);
		$all_members = implode("_",$array_all_members);
		$message_group = new MessageGroups();
		$message_group->all_members = $all_members;
		$message_group_id = $message_group->create_Atom_message_group();
		//send message
		$id_user = Yii::app()->user->id;
		$type='1';
		$objMessage = new Messages();
        $objMessage->sender_id = $id_user;
		$objMessage->type = $type;
        $objMessage->message_group_id = $message_group_id;
        $objMessage->message = $_POST['message_sended'];
        $objMessage->created = time();
		if($objMessage->sendMessage())
		{
			$callback['success'] = true;
			$callback['message_group_id'] = $message_group_id;
			$callback['last_message_sended'] = CHtml::encode($_POST['message_sended']);
		}
		else
		{
			$callback['success'] = false;
			$callback['error'] = 'cant send message';
		}
		echo json_encode($callback);	
	}
	
	function actionLoadCheckMessage()
	{
		$user_id = Yii::app()->user->id;
		$objUsers = new AtomUsers();
		$objUsers->updateByPk($user_id, array('ping'=>time()));
		
		$objMessageGroupMember = MessageGroupMembers::model()->findAll("user_id = '$user_id' and is_read = '0'");
		if ($objMessageGroupMember)
		{
			$arrat_json = array();
			foreach ($objMessageGroupMember as $message_group)
			{
				$temp['message_group_id'] = $message_group->message_group_id;
				$temp['last_message_id'] = $message_group->last_message_id;
				//读取该组最后一条message
				$objMessages = Messages::model()->find(array(
						'condition' => "message_group_id  = $message_group->message_group_id",
						'order' => 'message_id DESC',
						'limit' => '1',
				));
				$temp['last_message_message'] = CHtml::encode($objMessages->message);
				$array_json[] = $temp;
			}
			$callback['array_json'] = $array_json;
			$callback['has_data'] = true;	
			
		}
		else
		{
			$callback['has_data'] = false;	
		}
		$callback['array_online'] = Messages::checkOnline($user_id);
		$callback['success'] = true;	
		echo json_encode($callback);	
	}
	
	function actionGetNoreadMessage($message_group_id,$last_message_id)
	{
		$objMessages = Messages::model()->findAll(array(
						'condition' => "message_group_id  = '$message_group_id' and message_id>'".$last_message_id."'",
						'order' => 'message_id ASC',
				));
		$id_user = Yii::app()->user->id;
		$data = array();
		$last_message_id;
		foreach ($objMessages as $objMessage)
		{
			$message = $objMessage->getAttributes();
			($message['sender_id'] == $id_user)?$message['senderClass']='me':$message['senderClass']='others';
			$message['realtime'] = date("h:i:s",$message['created']); 
			$message['firstname'] = $objMessage->sender->firstname;
			$message['lastname'] = $objMessage->sender->lastname;
			$message['avatar'] = $objMessage->sender->avatar;
			$last_message_id = $message['message_id'];
			$data[] = $message;
		}
		//获取message结束，将之标记为已读
			$objMessagegroupmember = new MessageGroupMembers();
			$objData = $objMessagegroupmember->find("message_group_id='$message_group_id' and user_id = '$id_user'");
			$Data = $objData->getAttributes();
			$objMessagegroupmember->updateByPk($Data["message_group_member_id"], array('last_message_id'=>$last_message_id,'is_read'=>'1'));   
		//返回页面
		$callback['success'] = true;		
		$callback['html'] = $this->renderPartial('messages',array('data' =>$data),true);
		echo json_encode($callback);	
	}
	
	function actionGetAddFriendList($str_search,$str_has_id)
	{
		$str_search = trim($str_search);
		$listchater = false;
		if ($str_search) {
			$listchater = Messages::GetAddFriendList($str_search,$str_has_id);
		}
		$callback['success'] = true;
		if($listchater)
		{
			$callback['html'] = $this->renderPartial('/im/listaddusers',array('listchater'=>$listchater),true);
		}
		else
		{
			$callback['html']='';
		}
		echo json_encode($callback);		
	}
	
	function actionrefreshMessageGroupList()
	{
		
		$textSearch = $_GET['textSearch'];
		
		$objUsers = new AtomUsers;
		$criteria = new CDbCriteria(array(
				'condition'=>"1 = 1 ", 
				'order'=>'t.firstname ASC',));
		if($textSearch)
		{
			$array_searchMessage =explode(" ",$textSearch);
			$array_searchMessage = array_filter(array_unique($array_searchMessage));
			
			 foreach ($array_searchMessage as $searchKey)
			{
				$criteria->addCondition('firstname like \'%'.$searchKey.'%\' or lastname like \'%'.$searchKey.'%\'');
			}
		}
		$objData = $objUsers->findAll($criteria);
		$arrayUserData = array();
		foreach($objData as $value) {
					$arrayAttr = $value->getAttributes();
					$arrayUserData[] = $arrayAttr['user_id'];
				}
		
		$objMessageGroupMembers = new MessageGroupMembers;;
		
		$callback['success'] = true;
		$callback['html'] = $textSearch;
		echo json_encode($callback);	
	}
}