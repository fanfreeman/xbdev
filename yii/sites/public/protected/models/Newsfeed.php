<?php

/**
 * This is the model class for table "newsfeeds".
 *
 * The followings are the available columns in table 'newsfeeds':
 * @property string $newsfeed_id
 * @property string $user_id
 * @property string $group_id
 * @property string $resource_id
 * @property string $resource_type
 * @property string $params
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property Feedcomments[] $feedcomments
 * @property Users $user
 */
class Newsfeed extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Newsfeed the static model class
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
		return 'newsfeeds';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('user_id, resource_id, resource_type, params, created, updated', 'required'),
			array('user_id, params, created', 'required'),
			array('user_id, group_id, resource_id, created, updated', 'length', 'max'=>10),
			array('resource_type', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('newsfeed_id, user_id, group_id, resource_id, resource_type, params, created, updated', 'safe', 'on'=>'search'),
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
			'feedcomments' => array(self::HAS_MANY, 'Feedcomments', 'newsfeed_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'newsfeed_id' => 'Newsfeed',
			'user_id' => 'User',
			'group_id' => 'Group',
			'resource_id' => 'Resource',
			'resource_type' => 'Resource Type',
			'params' => 'Params',
			'created' => 'Created',
			'updated' => 'Updated',
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

		$criteria->compare('newsfeed_id',$this->newsfeed_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('resource_id',$this->resource_id,true);
		$criteria->compare('resource_type',$this->resource_type,true);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function sendNewsfeed($newsfeed_content)
	{
		$id_user = Yii::app()->user->id;
		$this->user_id = $id_user;
		$this->params = $newsfeed_content;
        $this->created = time();
		if (!$this->save()){
			return false;
        }
		else
		{return $this->newsfeed_id;}
	}
	
	public static function getListNewsfeeds($id_user,$intLimit,$last_newsfeed_id)
	{
		//$id_user = Yii::app()->user->id;
		$objFollower = new Follows;
		$objFollower->follower_id = $id_user;
		$array_following = $objFollower->getListFollowing();
		array_push($array_following,$id_user);
		$criteria = new CDbCriteria(array(
                //'condition' => "user_id = '$id_user'", 
                'order'=>'t.created DESC',
                'limit' => $intLimit,
				//'offset' => '5',
        ));
		if($last_newsfeed_id)
		{
			 $criteria->addCondition("newsfeed_id < ".$last_newsfeed_id, 'AND');
		}
		$criteria->addInCondition('user_id', $array_following,'AND');
		$objNewsfeed = Newsfeed::model()->findAll($criteria);
		$dataNewsfeeds = array();
		foreach ($objNewsfeed as $newsfeed)
		{
			$temp = $newsfeed->getAttributes();
			
			$temp['firstname'] = $newsfeed->user->firstname;
			$temp['lastname'] = $newsfeed->user->lastname;
			$temp['avatar'] = $newsfeed->user->avatar;
			$temp['strfeedcomments'] = FeedComments::getStrComment(count($newsfeed->feedcomments));
			$temp['realtime'] = date("h:i:s",$temp['created']);
			$dataNewsfeeds[] = $temp;
			
		}
		return $dataNewsfeeds;
	}
}