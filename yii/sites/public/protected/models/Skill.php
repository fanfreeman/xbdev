<?php

/**
 * This is the model class for table "skills".
 *
 * The followings are the available columns in table 'skills':
 * @property string $skill_id
 * @property string $skill
 * @property string $created
 *
 * The followings are the available model relations:
 * @property UserSkills[] $userSkills
 */
class Skill extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Skill the static model class
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
		return 'skills';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('skill, created', 'required'),
			array('skill', 'length', 'max'=>50),
			array('created', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('skill_id, skill, created', 'safe', 'on'=>'search'),
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
			'userSkills' => array(self::HAS_MANY, 'UserSkills', 'skill_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'skill_id' => 'Skill',
			'skill' => 'Skill',
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

		$criteria->compare('skill_id',$this->skill_id,true);
		$criteria->compare('skill',$this->skill,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getIdBySkill()
	{
		if ($model =  $this->model()->find("skill = '$this->skill'"))
		{
			return $model->skill_id;
		}
		else
		{
			$this->created = time();
			if(!$this->save())
			{
				return false;	
			}
			else
			{
				return $this->skill_id;
			}
		
		}
	}
	
	public function getTagbySkill()
	{
		if ($dataSkills =  $this->model()->findAll("skill like '%$this->skill%'"))
		{
			$dataReturn = array();
			foreach ($dataSkills as $skill)
			{
				$dataReturn[] = $skill->skill_id;
			}	
			return $dataReturn;
		}
		else
		{
			return false;
		}
	}
}