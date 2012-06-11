<?php

/**
 * This is the model class for table "groups".
 *
 * The followings are the available columns in table 'groups':
 * @property string $group_id
 * @property string $name
 * @property string $description
 * @property integer $type
 * @property string $created
 * @property string $father_id
 * @property string $tree_id
 * @property string $tree_level
 */
class Groups extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Groups the static model class
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
        return 'groups';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, type, created, father_id', 'required'),
            array('type', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>45),
            array('description', 'length', 'max'=>140),
            array('created, father_id, tree_id, tree_level', 'length', 'max'=>10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('group_id, name, description, type, created, father_id, tree_id, tree_level', 'safe', 'on'=>'search'),
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
            'group_id' => 'Group',
            'name' => 'Name',
            'description' => 'Description',
            'type' => 'Type',
            'created' => 'Created',
            'father_id' => 'Father',
            'tree_id' => 'Tree',
            'tree_level' => 'Tree Level',
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

        $criteria->compare('group_id',$this->group_id,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('type',$this->type);
        $criteria->compare('created',$this->created,true);
        $criteria->compare('father_id',$this->father_id,true);
        $criteria->compare('tree_id',$this->tree_id,true);
        $criteria->compare('tree_level',$this->tree_level,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
	
	
	public function getIdByGroupName()
	{
		$this->tree_level++;
		if ($model =  $this->model()->find("name = '$this->name' 
														  and father_id = '$this->father_id' 
														  and tree_level = '$this->tree_level'"))
		{
			return array('group_id'=>$model->group_id,
							  'tree_level'=>$model->tree_level,
							  'tree_id'=>$model->tree_id);
		}
		else
		{
			$this->created = time();
			$this->type = '1';
			//$this->tree_id = '0';
			
			if(!$this->save())
			{
				return false;	
			}
			else
			{
				if ($this->tree_id=='0')
				{
					$this->tree_id = $this->group_id;
					$this->save();
				}
				return array('group_id'=>$this->group_id,
								 'tree_level'=>$this->tree_level,
								 'tree_id'=>$this->tree_id);
			}
		
		}
	}
	
	public static function getListPosition($position)
	{
		if($position)
		{
			return array_reverse(Groups::getListPositionByUser($position));
		}
		else
		{
			return array();
		}
	}
	
	public static function getListPositionByUser($position)
	{
		
		$array_position = array();
		Groups::getGroupById($position,&$array_position);
		return $array_position;
	}
	
	public static function getGroupById($group_id,$array_position)
	{
		$objGroup = new Groups;
		$model = $objGroup->model()->findByPk($group_id);
		$temp = array('group_id'=>$model->group_id,'name'=>$model->name,'father_id'=>$model->father_id);
		$array_position[] = $temp;
		if ($model->father_id!='0')
		{
			Groups::getGroupById($model->father_id,&$array_position);
		}
	}
	
	public static function getGroupsChildren($group_id)
	{
		$array_groups = array($group_id);
		Groups::getGroupchild($group_id,&$array_groups);
		return $array_groups;
	}
	
	public static function getGroupchild($group_id,$array_groups)
	{
		$objGroup = new Groups;
		if ($objData =  $objGroup->findAll("father_id = '$group_id'"))
		{
			foreach($objData as $value) {
					array_push($array_groups,$value->group_id);
					Groups::getGroupchild($value->group_id,&$array_groups);
				}
		}
	}
} 