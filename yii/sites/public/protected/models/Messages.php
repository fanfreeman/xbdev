<?php

/**
 * This is the model class for table "Atom_messages".
 *
 * The followings are the available columns in table 'Atom_messages':
 * @property string $message_id
 * @property string $type
 * @property string $sender_id
 * @property string $message_group_id
 * @property string $message
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Users $sender
 * @property AtomMessageGroups $messageGroup
 */
class Messages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Atommessages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, sender_id, message_group_id, message, created', 'required'),
			array('type', 'length', 'max'=>1),
			array('sender_id, message_group_id, created', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('message_id, type, sender_id, message_group_id, message, created', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'sender' => array(self::BELONGS_TO, 'Users', 'sender_id'),
			'messageGroup' => array(self::BELONGS_TO, 'MessageGroups', 'message_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'message_id' => 'Message',
			'type' => 'Type',
			'sender_id' => 'Sender',
			'message_group_id' => 'Message Group',
			'message' => 'Message',
			'created' => 'Created',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		$criteria->compare('message_id',$this->message_id,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('sender_id',$this->sender_id,true);
		$criteria->compare('message_group_id',$this->message_group_id,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function sendMessage()
	{
		if (!$this->save()){
			return false;
        }
		else
		{
			$id_user = Yii::app()->user->id;
			//update late_message_id
			$objMessagegroupmember = new MessageGroupMembers();
			$objData = $objMessagegroupmember->find("message_group_id='".$this->message_group_id."' and user_id = '$id_user'");
			$Data = $objData->getAttributes();
			$objMessagegroupmember->updateByPk($Data["message_group_member_id"], array('last_message_id'=>$this->message_id));
			//send is_read=>0
			$objMessagegroupmembers = new MessageGroupMembers();
			//$objDatas = $objMessagegroupmembers->findAll("message_group_id='".$this->message_group_id."' and user_id != '$id_user' and last_message_id !='$this->message_id'");
			$objDatas = $objMessagegroupmembers->findAll("message_group_id='".$this->message_group_id."' and user_id != '$id_user'");
			foreach($objDatas as $value) {
				$arrayData = $value->getAttributes();
				if($arrayData['last_message_id'])
				{
        			$objMessagegroupmembers->updateByPk($arrayData['message_group_member_id'], array('is_read'=>'0'));	
				}
				else
				{
					$objMessagegroupmembers->updateByPk($arrayData['message_group_member_id'], array('last_message_id'=>'0','is_read'=>'0'));	
				}
			}	
		}
		return $this;
	}
	
	public static function GetAddFriendList($str_search,$str_has_id)
   		{
		 if (empty($str_search)) {
            	return false;
        	}

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
				$objData = AtomUsers::model()->findAll($criteria);
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
		
	public static function get_userinfo_by_ids($other_members)
	{
		$array_userID = explode("_",$other_members);
		$data_users = array();
		foreach ($array_userID as $user_id)
		{
			if($modelUser = AtomUsers::model()->findByPk($user_id))
			{
			$user = $modelUser->getAttributes();
			$data_users[] = $user;
			}
		}
		return $data_users;
	}
	
	public function get_format_messages($last_message_id)
	{
		$dataMessages = array();	
		$id_user = Yii::app()->user->id;
		$modelMessages = $this->findAll(
			array('condition'=>"message_group_id = '$this->message_group_id' and message_id > '$last_message_id'", 
					'order'=>'t.created ASC',
					));
		$temp;
		if ($modelMessages)
		{
			foreach($modelMessages as $message)
			{
				$temp = $message->getAttributes();
				($message['sender_id']==$id_user)?$temp['senderClass']='me':$temp['senderClass']='others';
				$temp['realtime'] = date("h:i:s",$message['created']);
				$temp['avatar'] = $message->sender->avatar;
				$temp['sender_firstname'] = $message->sender->firstname;
				$dataMessages[] = $temp;
			}
		 }
		 return $dataMessages;
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
				if(isset($arrayData['ping'])&&($str_time-$arrayData['ping']<3))
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
}