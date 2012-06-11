<?php

class NewsFeeds extends Model implements ResourceInterface
{
    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{newsfeeds}}';
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('resource_id, resource_type', 'required', 'message' => '{attribute} 不能为空'),
		);
	}

    // interface begin
    // 获取标题
    public function getTitle($intResourceId)
    {
        $objInfo = self::model()->findByPk($intResourceId);
        if ($objInfo) {
            if ($objInfo->params) {
                $arrayParma = unserialize($objInfo->params);

                return $arrayParma['content'];
            }

            return '';
        }

        return false;
    }
    // 获取url
    public function getUrl($intResourceId)
    {
        return 'xxxx?id='.$intResourceId;
    }
    // 格式话feed
    public function formatFeed($intResourceId, $strParam)
    {
        //
    }
    // 格式话提醒
    public function formatNotification($intResourceId)
    {
        //
    }
    // 获取资源内容
    public function getContent($intResourceId)
    {
        return $this->getTitle($intResourceId);
    }
    // interface end

    
}

?>
