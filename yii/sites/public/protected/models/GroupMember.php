<?php

/**
 * This is the model class for table "group_member".
 *
 * The followings are the available columns in table 'group_member':
 * @property string $group_member_id
 * @property string $user_id
 * @property string $group_id
 * @property integer $status
 * @property string $message
 */
class GroupMember extends Model
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GroupMember the static model class
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
		return 'group_member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	

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
			'group_member_id' => 'Group Member',
			'user_id' => 'User',
			'group_id' => 'Group',
			'status' => 'Status',
			'message' => 'Message',
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

		$criteria->compare('group_member_id',$this->group_member_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}