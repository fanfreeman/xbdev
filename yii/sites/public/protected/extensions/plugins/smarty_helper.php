<?php


// 获取用户信息 {getUserInfo($val.id, 'username')}
function getUserInfo($intUserId, $strColumn) {
	static $arrayUsers = array();
	if (!isset($arrayUsers[$intUserId])) {
		$arrayUsers[$intUserId] = bizUser::getInfo(array('user_id'=>$intUserId));
	}
	return isset($arrayUsers[$intUserId][$strColumn]) ? $arrayUsers[$intUserId][$strColumn] : '';
}

// 获取notification信息 {getNotificationUserInfo($val.id, 'resource_type')}$resource_id, $resource_type
function getFeedcomment($resource_id) {
	$comment = bizFeedcomments::getFeedcomment($resource_id);
	return($comment);
}

function getNotificationType($resource_type){
	return(bizNotifications::getTypeNotification($resource_type));
	}

function getCheckLiked($resource_id, $resource_type){
	return(bizLikes::checkLiked(Yii::app()->user->id, $resource_id, $resource_type)); 
	}
	
function getCheckFollow($following_id){
	return(bizFollower::checkFollower(Yii::app()->user->id,$following_id)); 
	}
?>