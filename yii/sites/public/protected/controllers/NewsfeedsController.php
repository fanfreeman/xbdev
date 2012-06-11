<?php

class NewsFeedsController extends Controller
{
	//news页面动作
	public function actionIndex()
	{ 
		$this->layout="//layouts/column_ms";
		$this->render('newsfeed');
	}

	public function actionShow()
	{
		if (isset($_GET['id'])) {
            $intFeedId = $_GET['id'];
            $arrayFeedData = bizNewsFeed::getNewsFeed($intFeedId);
            $arrayCommentData = bizNewsFeed::getComments($intFeedId);
        }

		$this->render('show', array(
            'data' => $arrayFeedData['data'],
            'comments' => $arrayCommentData['data']
            ));
	}

    public function actionLoadNewsFeedListAjax($load_type,$newsfeed_id)
    {	 
		$arrayParam = array();
		$arrayParam["user_id"] = Yii::app()->user->id;
		
		switch($load_type){
			case("first_load"):{break;}
			case("scroll_load"):{ $arrayParam["max_id"] = $newsfeed_id-1;break;}
			case("top_load"):{ $arrayParam["since_id"] = $newsfeed_id+1;break;}
			default:break;
			}			
		$followingfeeds = bizUser::getFollowingFeed($arrayParam);
		$this->renderPartial('news',array('followingfeeds'=>$followingfeeds,'load_type'=>$load_type));	
			
		
    }

    //动态读取newsfeed详情
	public function actionLoadNewsFeedDetailAjax($newsfeed_id)
    {
	    $newsfeed =  bizNewsFeed::getNewsFeed($newsfeed_id);		//通过id读取newsfeed信息
		$this->renderPartial('_ajaxLoadNewsFeedDetail', $newsfeed);
    }


    public function actionSaveNewsFeedAjax()
    {
		$param = array('content'=>$_POST["params"]);	
		if($add_newsfeed_id = bizNewsFeed::add(Yii::app()->user->id,'1',bizNewsFeed::FeedType,0, $param))
		{//存储成功，读取最后一个id
			$arrayParam = array();
			$arrayParam["user_id"] = Yii::app()->user->id;
				{
					$arrayParam["max_id"] = $add_newsfeed_id;
					//$arrayParam["since_id"] = $add_newsfeed_id;
					$arrayParam["since_id"] = $_POST["first_newsfeed_id"]+1;  
				}
			$followingfeeds = bizUser::getFollowingFeed($arrayParam);
			$this->renderPartial('news',array('followingfeeds'=>$followingfeeds,'load_type'=>'add_newsfeed'));
		
			}
		else
		{//存储失败
			}
		
    }
	
	//读取评论列表
	public function actionLoadListCommentsAjax($feedId,$id_comment)
    {	 
		$arrayParam = array();
		if ($id_comment!="first_load")
		{
			$arrayParam['max_id'] = $id_comment-1;
			}
		$list_comments = bizNewsFeed::getComments($feedId, 20,1,$arrayParam);
		//echo $id_comment;
		$this->renderPartial('comments',array('list_comments'=>$list_comments));
	}	
	
	//检查是否有新的newsfeed
	public function actionCheckIfHaveNewNewsFeed($first_newsfeed_id)
	{
		//echo $first_newsfeed_id;
			$arrayParam = array();
		$arrayParam["user_id"] = Yii::app()->user->id;
		$arrayParam["first_newsfeed_id"] = $first_newsfeed_id;
		$followingfeeds = bizUser::getNewNewsfeedId($arrayParam);
		echo $followingfeeds["intTotal"];
		}
	
//newsfeed添加评论    
	public function actionAddComment()
    {	 
		if($feedcomment_id = bizNewsFeed::addComment(Yii::app()->user->id,$_POST["intFeedId"],$_POST["feedcomment_content"],0))
		{//评论成功
		 //发送notification
		 	$newsfeed =  bizNewsFeed::getNewsFeed($_POST["intFeedId"]);	
			$user_id_commentee = $newsfeed["data"]["user_id"]; //读取接受评论者ID
			bizNotifications::add($user_id_commentee, $feedcomment_id, "2"); //向接受评论者发送notification
			
			$list_comments = bizFeedcomments::getFeedcomment($feedcomment_id);
			$this->renderPartial('comment',array('comments'=>$list_comments));
		}
		else
		{//评论失败
			
		}
    }

	public function actionChangeCommentNum()
    {	 
		echo bizNewsFeed::getCommentNum($_POST["intFeedId"]);
    }
}



?>
