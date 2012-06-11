<?php

/**
 * This is the model class for table "message_notifications".
 *
 * The followings are the available columns in table 'message_notifications':
 * @property string $message_notification_id
 * @property string $message_group_id
 * @property string $user_id
 * @property string $new_message_num
 */
class MessageNotifications extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return MessageNotifications the static model class
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
		return 'message_notifications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('message_group_id, user_id', 'required'),
			array('message_group_id, user_id, new_message_num', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('message_notification_id, message_group_id, user_id, new_message_num', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'message_notification_id' => 'Message Notification',
			'message_group_id' => 'Message Group',
			'user_id' => 'User',
			'new_message_num' => 'New Message Num',
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

		$criteria->compare('message_notification_id',$this->message_notification_id,true);
		$criteria->compare('message_group_id',$this->message_group_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('new_message_num',$this->new_message_num,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}