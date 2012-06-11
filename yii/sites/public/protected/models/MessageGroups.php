<?php

/**
 * This is the model class for table "atom_message_groups".
 *
 * The followings are the available columns in table 'atom_message_groups':
 * @property string $message_group_id
 * @property string $all_members
 * @property string $created
 *
 * The followings are the available model relations:
 * @property AtomMessageGroupMembers[] $atomMessageGroupMembers
 * @property AtomMessages[] $atomMessages
 */
class MessageGroups extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AtomMessagegroups the static model class
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
		return 'message_groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('all_members, created', 'required'),
			array('all_members', 'length', 'max'=>45),
			array('created', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('message_group_id, all_members, created', 'safe', 'on'=>'search'),
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
			'MessageGroupMembers' => array(self::HAS_MANY, 'MessageGroupMembers', 'message_group_id'),
			'Messages' => array(self::HAS_MANY, 'Messages', 'message_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'message_group_id' => 'Message Group',
			'all_members' => 'All Members',
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

		$criteria->compare('message_group_id',$this->message_group_id,true);
		$criteria->compare('all_members',$this->all_members,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function create_Atom_message_group()
	{
		$objResult = $this->find("all_members= '$this->all_members'");
		if (!empty($objResult)) {
				 return $objResult->message_group_id;
			}
		$this->created = time();
		if (!($this->save())) {
				return false;
			}
		$array_members =explode("_",$this->all_members);
		foreach ($array_members as $key=>$intUserId)
			{
				$arrat_temp = $array_members;
				unset($arrat_temp[$key]);
				$arrat_temp = array_filter(array_unique($arrat_temp));
				sort($arrat_temp);
				$other_members = implode('_',$arrat_temp);	
				$objMessageGroupMembers = new MessageGroupMembers(); 
				$objMessageGroupMembers->message_group_id = $this->message_group_id;
            	$objMessageGroupMembers->user_id = $intUserId;
				$objMessageGroupMembers->other_members = $other_members;
				//$objMessageGroupMembers->last_message_id = '1';
				$objMessageGroupMembers->is_read = '1';
				$objMessageGroupMembers->save();
			}
		return $this->message_group_id;	
	}
	
	public static function LoadCreatMessage_group($id_chater)
	{
		//组合成ALL
		$user_id = Yii::app()->user->id;
		$array_all_members = array($user_id,$id_chater);
		$array_all_members = array_filter(array_unique($array_all_members));
		sort($array_all_members);
		$all_members = implode("_",$array_all_members);
		$message_group = new MessageGroups();
		$message_group->all_members = $all_members;
		if ($message_group_id = $message_group->create_Atom_message_group())
		{
		$callback['success'] = true;	
		$callback['message_group_id'] = $message_group_id;	
		}
		else
		{
		$callback['success'] = false;
		$callback['error'] = "fall to load message_gourp_id";	
		}
		return $callback;
	}
}