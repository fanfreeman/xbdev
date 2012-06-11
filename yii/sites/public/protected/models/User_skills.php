<?php

/**
 * This is the model class for table "user_skills".
 *
 * The followings are the available columns in table 'user_skills':
 * @property string $user_skill_id
 * @property string $user_id
 * @property string $skill_id
 *
 * The followings are the available model relations:
 * @property Skills $skill
 * @property Users $user
 */
class User_skills extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User_skills the static model class
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
		return 'user_skills';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, skill_id', 'required'),
			array('user_id, skill_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_skill_id, user_id, skill_id', 'safe', 'on'=>'search'),
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
			'skill' => array(self::BELONGS_TO, 'Skill', 'skill_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_skill_id' => 'User Skill',
			'user_id' => 'User',
			'skill_id' => 'Skill',
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

		$criteria->compare('user_skill_id',$this->user_skill_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('skill_id',$this->skill_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function save_user_skill()
	{
		if ($model =  $this->model()->find("user_id = '$this->user_id' and skill_id = '$this->skill_id'"))
		{
			return 'already_add';
		}
		else
		{
			if(!$this->save())
			{
				return false;	
			}
			else
			{
				return $this->user_skill_id;
			}
		
		}
	}
	
	public function searchUserByTag($search)
	{
		$objSkill = new Skill;
		$objSkill->skill = $search;
		if (!$array_skill_id = $objSkill->getTagbySkill())
		{
			return false;
			}
		
		$criteria = new CDbCriteria(array(
				'condition'=>"1 = 1 ", 
				));
				
		$criteria->addInCondition('skill_id',$array_skill_id,'AND');
		if($objData = $this->model()->findAll($criteria))
		{
			$dataReturn = array();
			foreach ($objData as $user_skill)
			{
				$dataReturn[] = $user_skill->user_id;
			}	
			 $dataReturn = array_filter(array_unique($dataReturn));
			return $dataReturn;
		}
		else
		{
			return false;
		}
				
	}
	
	public function searchUserBySkill_id($skill_id)
	{
		$criteria = new CDbCriteria(array(
				'condition'=>"1 = 1 ", 
				));
				
		$criteria->addCondition('skill_id =\''.$skill_id.'\'');
		if($objData = $this->model()->findAll($criteria))
		{
			$dataReturn = array();
			foreach ($objData as $user_skill)
			{
				$dataReturn[] = $user_skill->user_id;
			}	
			 $dataReturn = array_filter(array_unique($dataReturn));
			return $dataReturn;
		}
		else
		{
			return false;
		}
				
	}
}