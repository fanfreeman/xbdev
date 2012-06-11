<?php

/**
 * This is the model class for table "Atom_message_group_members".
 *
 * The followings are the available columns in table 'Atom_message_group_members':
 * @property string $message_group_member_id
 * @property string $message_group_id
 * @property string $user_id
 * @property string $other_members
 * @property string $last_message_id
 * @property integer $is_read
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property AtomMessages $lastMessage
 * @property AtomMessageGroups $messageGroup
 */
 //last_message_id: null:该组没有对话;0：该用户还未读过组内消息
class MessageGroupMembers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AtomMessagegroupmembers the static model class
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
		return 'message_group_members';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('message_group_id, user_id, other_members', 'required'),
			array('is_read', 'numerical', 'integerOnly'=>true),
			array('message_group_id, user_id, last_message_id', 'length', 'max'=>10),
			array('other_members', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('message_group_member_id, message_group_id, user_id, other_members, last_message_id, is_read', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			//'lastMessage' => array(self::BELONGS_TO, 'AtomMessages', 'last_message_id'),
			'messageGroup' => array(self::BELONGS_TO, 'MessageGroups', 'message_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'message_group_member_id' => 'Message Group Member',
			'message_group_id' => 'Message Group',
			'user_id' => 'User',
			'other_members' => 'Other Members',
			'last_message_id' => 'Last Message',
			'is_read' => 'Is Read',
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

		$criteria->compare('message_group_member_id',$this->message_group_member_id,true);
		$criteria->compare('message_group_id',$this->message_group_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('other_members',$this->other_members,true);
		$criteria->compare('last_message_id',$this->last_message_id,true);
		$criteria->compare('is_read',$this->is_read);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function update_last_message_id($last_message_id)
	{
		$objData = $this->find("message_group_id='$this->message_group_id' and user_id = '$this->user_id'");
		$this->updateByPk($objData->message_group_member_id, array('last_message_id'=>$last_message_id,'is_read'=>'1'));   
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
				
				$objDirectory = new AtomUsers;
				$objData = $objDirectory->findAll($criteria);
		
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