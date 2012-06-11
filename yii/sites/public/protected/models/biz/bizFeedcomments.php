<?php
class bizFeedcomments
{		
    // interface begin
    // 获取标题
    public static function getFeedcomment($feedcomment_id)
    {
	  $objInfo = Feedcomments::model()->find('feedcomment_id = :feedcomment_id', array(':feedcomment_id' => $feedcomment_id));
	   if ($objInfo) {
			$arrayData = $objInfo->getAttributes();
			if ($arrayData['content']) {
			$arrayData['content'] = unserialize($arrayData['content']);
		}
			return($arrayData);
		}
        return false;
	}
	
}

?>
