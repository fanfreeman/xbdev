<?php

class FeedCommentsController extends Controller
{	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
		{
			return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
					'actions'=>array('LoadComments','SendComment'),
					'users'=>array('@'),
				),
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
		}
	
	public function actionLoadComments()
	{
	$newsfeed_id = $_GET['newsfeed_id'];	
	$criteria = new CDbCriteria(array(
                'condition' => "newsfeed_id = '$newsfeed_id'", 
                'order'=>'t.created DESC',
                //'limit' => $intCount,
        ));
	$objCommend = FeedComments::model()->findAll($criteria);
	if($objCommend)
	{
		$dataComments = array();
		foreach ($objCommend as $comment)
		{
			$temp = $comment->getAttributes();
			$temp['firstname'] = $comment->user->firstname;
			$temp['lastname'] = $comment->user->lastname;
			$temp['avatar'] = $comment->user->avatar;
			$dataComments[] = $temp;
		}
		$callback['success'] = true;
		$callback['html'] = $this->renderPartial('/FeedComments/commends',array('dataComments'=>$dataComments),true);
	}
	echo json_encode($callback);
	}
	
	public function actionSendComment()
	{
	$newsfeed_id = $_GET['newsfeed_id'];	
	$comment_content = $_GET['comment_content'];	
	
	$objFeedComments = new FeedComments();
	if(!$objFeedComment = $objFeedComments->sendComment($_GET['newsfeed_id'],$_GET['comment_content']))
		{$callback['success'] = false;
		 $callback['error'] = "fall send comment";
		}
		else
		{
		$callback['success'] = true;
			$temp = $objFeedComment->getAttributes();
			$temp['firstname'] = $objFeedComment->user->firstname;
			$temp['lastname'] = $objFeedComment->user->lastname;
			$temp['avatar'] = $objFeedComment->user->avatar;
		$dataComments = array($temp);
		//计算评论个数
		$objNewsfeed = Newsfeed::model()->findBypk($newsfeed_id);
		$callback['strfeedcomments'] =  FeedComments::getStrComment(count($objNewsfeed->feedcomments));
		$callback['html'] = $this->renderPartial('/FeedComments/commends',array('dataComments'=>$dataComments),true);
		/*
		$dataNewsfeeds = array();
		$id_user = Yii::app()->user->id;
		$modelUser=AtomUsers::model()->findByPk($id_user);
		$temp['newsfeed_id'] = $newsfeed_id;
		$temp['firstname'] = $modelUser->firstname;
		$temp['lastname'] = $modelUser->lastname;
		$temp['avatar'] = $modelUser->avatar;
		$temp['params'] = $_GET['newsfeed_content'];
		$temp['created'] = time();
		$dataNewsfeeds[] = $temp;
		
		$callback['html'] = $this->renderPartial('newsfeeds',array('dataNewsfeeds'=>$dataNewsfeeds),true);
		*/
		}
		echo json_encode($callback);
	}
	

}