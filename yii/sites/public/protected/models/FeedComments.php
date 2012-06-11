<?php

/**
 * This is the model class for table "feedcomments".
 *
 * The followings are the available columns in table 'feedcomments':
 * @property string $feedcomment_id
 * @property string $newsfeed_id
 * @property string $user_id
 * @property string $content
 * @property string $created
 * @property string $reply_to_id
 *
 * The followings are the available model relations:
 * @property Newsfeeds $newsfeed
 * @property Users $replyTo
 * @property Users $user
 */
class FeedComments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Feedcomments the static model class
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
		return 'feedcomments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('newsfeed_id, user_id, content, created, reply_to_id', 'required'),
			array('newsfeed_id, user_id, created, reply_to_id', 'length', 'max'=>10),
			array('content', 'length', 'max'=>140),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('feedcomment_id, newsfeed_id, user_id, content, created, reply_to_id', 'safe', 'on'=>'search'),
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
			'newsfeed' => array(self::BELONGS_TO, 'Newsfeeds', 'newsfeed_id'),
			'replyTo' => array(self::BELONGS_TO, 'Users', 'reply_to_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'feedcomment_id' => 'Feedcomment',
			'newsfeed_id' => 'Newsfeed',
			'user_id' => 'User',
			'content' => 'Content',
			'created' => 'Created',
			'reply_to_id' => 'Reply To',
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

		$criteria->compare('feedcomment_id',$this->feedcomment_id,true);
		$criteria->compare('newsfeed_id',$this->newsfeed_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('reply_to_id',$this->reply_to_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function sendComment($newsfeed_id,$comment_content)
	{
		$id_user = Yii::app()->user->id;
		$this->newsfeed_id = $newsfeed_id;
		$this->user_id = $id_user;
		$this->content = $comment_content;
		$this->created = time();
		$objNewsfeed = Newsfeed::model()->findByPk($newsfeed_id);
		$this->reply_to_id = $objNewsfeed->user_id;
		if (!$this->save()){
			return false;
        }
		else
		{return $this;}
	}
	
	public static function getStrComment($count_feedcomments)
	{
		switch($count_feedcomments)
		{
			case "0":
			return "Add comment";
			break;
			case "1":
			return "1 comment";
			break;
			default:
			return $count_feedcomments." comments";
			break;
		}
	}
}