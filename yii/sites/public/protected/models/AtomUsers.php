<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $password
 * @property string $email
 * @property string $created
 * @property string $updated
 * @property string $onlinetime
 * @property string $avatar
 *
 * The followings are the available model relations:
 * @property AtomMessageGroupMembers[] $atomMessageGroupMembers
 * @property AtomMessages[] $atomMessages
 */
class AtomUsers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AtomUsers the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, lastname, password, email, created, updated, onlinetime', 'required'),
			array('firstname, lastname', 'length', 'max'=>45),
			array('password, avatar', 'length', 'max'=>255),
			array('email', 'length', 'max'=>80),
			array('created, updated, onlinetime', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, firstname, lastname, password, email, created, updated, onlinetime, avatar', 'safe', 'on'=>'search'),
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
			'atomMessageGroupMembers' => array(self::HAS_MANY, 'AtomMessageGroupMembers', 'user_id'),
			'atomMessages' => array(self::HAS_MANY, 'AtomMessages', 'sender_id'),
			'user_skills' => array(self::HAS_MANY, 'User_skills', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'password' => 'Password',
			'email' => 'Email',
			'created' => 'Created',
			'updated' => 'Updated',
			'onlinetime' => 'Onlinetime',
			'avatar' => 'Avatar',
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

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('onlinetime',$this->onlinetime,true);
		$criteria->compare('avatar',$this->avatar,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getListPosition()
	{
		if($this->position)
		{
			return array_reverse(Groups::getListPositionByUser($this->position));
		}
		else
		{
			return array();
		}
	}
}