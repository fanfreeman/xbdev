<?php

class NewsfeedController extends Controller
{	
	public $layout='//layouts/atom';
	
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
					'actions'=>array('index','Indexajax','SendNewsfeed','bizSendNewsfeed','SearchNewsfeed','LoadNewsfeedSince'),
					'users'=>array('@'),
				),
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
		}
	
	public function actionIndex()
	{
		$id_user = Yii::app()->user->id;
		$dataNewsfeeds = Newsfeed::getListNewsfeeds($id_user,20,false);
		$this->render('index',array('dataNewsfeeds'=>$dataNewsfeeds));	
	}
	
	public function actionLoadNewsfeedSince()
	{
		$id_user = Yii::app()->user->id;
		$dataNewsfeeds = Newsfeed::getListNewsfeeds($id_user,20,$_GET['since_newsfeed_id']);
		$callback['success'] = true;
		$callback['html'] = $this->renderPartial('newsfeeds',array('dataNewsfeeds'=>$dataNewsfeeds),true);
		echo json_encode($callback);	
	}
	
	public function actionIndexajax()
	{
		$id_user = Yii::app()->user->id;
		$dataNewsfeeds = Newsfeed::getListNewsfeeds($id_user,20,false);
		$callback['success'] = true;
		$callback['html'] = $this->renderPartial('index',array('dataNewsfeeds'=>$dataNewsfeeds),true);
		echo json_encode($callback);	
	}
	
	public function actionSendNewsfeed()
	{
		$objNewsfeed = new Newsfeed();
		if(!$newsfeed_id = $objNewsfeed->sendNewsfeed($_GET['newsfeed_content']))
		{$callback['success'] = false;
		 $callback['error'] = "fall send newsfeed";
		}
		else
		{
		$callback['success'] = true;
		
		$dataNewsfeeds = array();
		$id_user = Yii::app()->user->id;
		$modelUser=AtomUsers::model()->findByPk($id_user);
		$temp['newsfeed_id'] = $newsfeed_id;
		$temp['firstname'] = $modelUser->firstname;
		$temp['lastname'] = $modelUser->lastname;
		$temp['avatar'] = $modelUser->avatar;
		$temp['params'] = $_GET['newsfeed_content'];
		$temp['created'] = time();
		$temp['strfeedcomments'] = FeedComments::getStrComment(0);
		$temp['realtime'] = date("h:i:s",$temp['created']);
		$dataNewsfeeds[] = $temp;
		
		$callback['html'] = $this->renderPartial('newsfeeds',array('dataNewsfeeds'=>$dataNewsfeeds),true);
		}
		echo json_encode($callback);
	}
	
	public function actionbizSendNewsfeed()
	{
		if(isset($_GET['type']))
		{
			$id_user = Yii::app()->user->id;
			$array_shareMembers = explode("_",$_GET['share_ids']);
			$array_shareMembers = array_filter(array_unique($array_shareMembers));
			sort($array_shareMembers);
			$array_shareusers = array();
				foreach($array_shareMembers as $sharemember)
				{
					$modelUser = AtomUsers::model()->findByPk($sharemember);
					$array_shareusers[] = $modelUser->firstname.' '.$modelUser->lastname;
				}
				$str_shareusers = implode(" , ",$array_shareusers);
			
				$str_user = Yii::app()->user->firstname.' '.Yii::app()->user->lastname;
				switch($_GET['type'])
				{
					case 'share_file':
						if(isset($_GET['file_id']))
						{
							// get file name from file id
							$objFileSystem = new FileSystem();
							$arrFileInfo = $objFileSystem->getFileInfo($_GET['file_id']);
							$strFileName = $arrFileInfo['filename'];
							$strExtension = $arrFileInfo['extension'];
							
							$newsfeed_content = $str_user.' shared a file ('.$strFileName . '.' . $strExtension.') with '.$str_shareusers.'.';
								$objNewsfeed = new Newsfeed();
								if(!$newsfeed_id = $objNewsfeed->sendNewsfeed($newsfeed_content))
								{
									$callback['success'] = false;
									$callback['error'] = "fall to send share file newsfeed";
								}
								else
								{
									$callback['success'] = true;
									$callback['result'] = 'share file newsfeed send ok';
								}
						}
						else
						{
						$callback['success'] = false;
						$callback['error'] = "fail to load file id";
						}
						break;
					default:
					$callback['success'] = false;
					$callback['error'] = "fail to load type";
				}
			
		}
		else
		{
			$callback['success'] = false;
		 	$callback['error'] = "fail to load type";
		}
		echo json_encode($callback);
	}
	
	public function actionSearchNewsfeed()
	{
		$newsfeedSearchText = $_GET['newsfeedSearchText'];
		$array_newsfeedSearch =explode(" ",$newsfeedSearchText);
		$array_newsfeedSearch = array_filter(array_unique($array_newsfeedSearch));
		
		$id_user = Yii::app()->user->id;
		$objFollower = new Follows;
		$objFollower->follower_id = $id_user;
		$array_following = $objFollower->getListFollowing();
		array_push($array_following,$id_user);
		$criteria = new CDbCriteria(array(
                //'condition' => "user_id = '$id_user'", 
                'order'=>'t.created DESC',
                //'limit' => $intCount,
        ));
		foreach ($array_newsfeedSearch as $searchKey)
		{
			$criteria->addSearchCondition('params',$searchKey,true,'AND');
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
			$temp['strfeedcomments'] =  FeedComments::getStrComment(count($newsfeed->feedcomments));
			$temp['realtime'] = date("h:i:s",$temp['created']);
			$dataNewsfeeds[] = $temp;
		}
		$callback['success'] = true;
		$callback['html'] = $this->renderPartial('newsfeeds',array('dataNewsfeeds'=>$dataNewsfeeds),true);	
		echo json_encode($callback);
	}
}