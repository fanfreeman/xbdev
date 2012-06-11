<?php

/**
 * This is the model class for table "message_group_archive".
 *
 * The followings are the available columns in table 'message_group_members':
 * @property string $message_group_member_id
 * @property string $message_group_id
 * @property string $user_id
 * @property integer $is_left
 */
class MessageArchive extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return MessageGroupMembers the static model class
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
		return '{{message_archive}}';
	}
}