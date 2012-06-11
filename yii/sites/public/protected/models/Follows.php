<?php

/**
 * This is the model class for table "follows".
 *
 * The followings are the available columns in table 'follows':
 * @property string $follow_id
 * @property string $follower_id
 * @property string $following_id
 * @property string $created
 */
class Follows extends Model
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Follows the static model class
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
		return 'follows';
	}
	
	public function getListFollowing()
	{
		$array_following = array();
		$objData = $this -> findAll("follower_id='".$this->follower_id."'");
		 if (!empty($objData)) {
			foreach ($objData as $following)
			{
				$array_following[] = $following->following_id;
			}
        }
		return $array_following;
	}

    public function checkFollower($follower_id,$following_id)
    {
        if (empty($follower_id)||empty($following_id)) {
            return false;
        }
		$this->follower_id = $follower_id;
		$this->following_id = $following_id;
		$objData = $this -> findByAttributes(array('follower_id' => $this->follower_id,'following_id' => $this->following_id));
        if (empty($objData)) {
            return false;
        }
		else
		{
			return $objData->getAttributes();
		}
    }
	
	public function addFollower($follower_id,$following_id)
    {
        if (empty($follower_id)||empty($following_id)) {
            return false;
        }
		$this->follower_id = $follower_id;
		$this->following_id = $following_id;
		
		if (!$this->save()){
			return false;
        }
		else {
			return true;
		}
    }
	
	public function deleteFollower($follow_id)
    {
	    if (empty($follow_id)) {
            return false;
        }
		if (!$this->deleteByPk($follow_id)){
				return false;
			}
			else {
				return true;
			}
    }	
}