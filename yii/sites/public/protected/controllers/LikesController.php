<?php

class LikesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	  
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

//newsfeed添加评论    
	public function actionCheckLikes()
    {	
		if(bizLikes::checkLiked(Yii::app()->user->id,$_POST["resource_id"],$_POST["resource_type"])=="liked")
		{//如果已经喜欢，则删除喜欢
			bizLikes::delete(Yii::app()->user->id,$_POST["resource_id"],$_POST["resource_type"]);
				$arraynewsfeed = bizNewsFeed::getNewsFeed($_POST["resource_id"]);
				$user_id_likee = $arraynewsfeed["data"]["user_id"]; //读取接受喜欢者ID			
				if(Yii::app()->user->id!=$user_id_likee) //ID不相同，才有可能存在notification
					{
						bizNotifications::delete($user_id_likee, $_POST["resource_id"], $_POST["resource_type"]);
					}
			echo "dislike ok";
		}
		else
		{//如果未喜欢，则加喜欢
			bizLikes::add(Yii::app()->user->id,$_POST["resource_id"],$_POST["resource_type"]);
				//读取newsfeed作者ID
				$arraynewsfeed = bizNewsFeed::getNewsFeed($_POST["resource_id"]);
				$user_id_likee = $arraynewsfeed["data"]["user_id"]; //读取接受喜欢者ID
				if(Yii::app()->user->id!=$user_id_likee)
				{
					bizNotifications::add($user_id_likee, $_POST["resource_id"], $_POST["resource_type"]); //向接受评论者发送notification
				}
			echo "addlike ok";
		}
    }	
	
	public function actionChangeLikeNum()
    {	
		echo bizLikes::countLiked($_POST["resource_id"], "3");
    }	
	
}
