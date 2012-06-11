<?php

class FollowsController extends Controller
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
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{ 
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Only Test.
	 * If add is successful, write 'success'.
	 */
	public function actionTinge($method = 'll', $page = 1)
	{
		$model = new Follows;
		if ($method == 'add') {
			if(bizFollower::add('222', '3'))
				exit('添加成功');
			else
				exit('添加失败');
		}elseif($method == 'delete') {
			if(bizFollower::delete('222', '3'))
				exit('删除成功');
			else
				exit('删除失败');
		}elseif ($method == 'll') {
			bizFollower::getAllFolowers('1');
		}else {
			$intUser_id = '1';
			$arrayList = bizFollower::getList($intUser_id, $page);
			foreach ($arrayList['data'] as $key => $val) {
				echo "follower_id:" . $val['follower_id'] . "\t" . $val['following_id'] . "<br />";
			}
			echo "下一页是" . $arrayList['next_page'];
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Follows;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Follows']))
		{
			$model->attributes=$_POST['Follows'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->follow_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Follows']))
		{
			$model->attributes=$_POST['Follows'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->follow_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	// public function actionTest()
	// {
	// 	echo Yii::app()->user->getFlash('tinge');
	// }
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Follows');

		//$a = Yii::app()->user->setFlash('tinge','操作成功');
		//$this->redirect('index.php?r=follows/test');
	
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionFollowStatus()
	{
		$id_user = Yii::app()->user->id;
		$objFollows = new Follows;
		$callback = array();
		
		if ($dataFollows = $objFollows->checkFollower($id_user,$_GET['following_id']))
		{
			if ($objFollows->deleteFollower($dataFollows['follow_id']))
			{
				$callback['success'] = true;
				$callback['type'] = 'deleteFollow';
			}
			else
			{
				$callback['success'] = false;	
				$callback['error'] = 'fall delete Follow';
			}
		}
		else
		{
			
			if($objFollows->addFollower($id_user,$_GET['following_id']))
			{
				$callback['success'] = true;
				$callback['type'] = 'addFollow';
			}
			else
			{
				$callback['success'] = false;	
				$callback['error'] = "fall add Follow";
			}
		}
		
		echo json_encode($callback);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Follows('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Follows']))
			$model->attributes=$_GET['Follows'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Follows::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='follows-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionCheckFollow($following_id)
	{
		$follower_id = Yii::app()->user->id;
		if ($follower_id!=$following_id) //不能加自己关注
		{
			if($follow_id=bizFollower::checkFollower($follower_id,$following_id))
			{
				//删除关注
				bizFollower::delete($follower_id,$following_id);
				echo "delete ok";
			}
			else
			{
				//添加关注
				bizFollower::add($follower_id,$following_id);
				echo "add ok";				
			}
		}
	}
}
