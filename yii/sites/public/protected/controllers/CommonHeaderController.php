<?php

class CommonHeaderController extends Controller
{	
	//public $layout='//layouts/atom';
	
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
					'actions'=>array('SettingsPop','changePassword','signOut'),
					'users'=>array('@'),
				),
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
		}
	
	public function actionSettingsPop()
	{
		$callback['success'] = true;
		$callback['html'] = $this->renderPartial('settingsPop','',true);
		echo json_encode($callback);	
	}
	
	public function actionchangePassword()
	{
		$password_current = $_POST['password_current'];
		$password_new = $_POST['password_new'];
		$password_retype = $_POST['password_retype'];
		$callback['success'] = true;
		if (empty($password_current))
		{
			$callback['passstatus'] = false;
			$callback['statusreason'] = 'current password empty';
		}
		else if (empty($password_new))
		{
			$callback['passstatus'] = false;
			$callback['statusreason'] = 'new password empty';
		}
		else if (empty($password_retype))
		{
			$callback['passstatus'] = false;
			$callback['statusreason'] = 'retype password empty';
		}
		else if ($password_new!=$password_retype)
		{
			$callback['passstatus'] = false;
			$callback['statusreason'] = 'password new retype diff';
		}
		else
		{
		 	$email = Yii::app()->user->email;
 	        $password  = trim($password_current);
	        $identity = new UserIdentity($email, $password);
			if (!$identity->authenticate()){
				$callback['passstatus'] = false;
				$callback['statusreason'] = 'current password false';
				}
				else
				{
				$user_id = Yii::app()->user->id;
				$modelUser=AtomUsers::model()->findByPk($user_id);
				$new_pass = Password::encrypt($password_new);
				//$callback['passstatus'] = false;
				//$callback['statusreason'] = $user_id;
				
				
				if (!$modelUser->updateByPk($user_id,array('password'=>$new_pass,'updated'=>time())))
				{
					$callback['passstatus'] = false;
					$callback['statusreason'] = 'cant save new pass';	
				}
				else
				{
					$callback['passstatus'] = true;
				}
			}
		}
		echo json_encode($callback);	
	}
	
	public function actionsignOut()
	{
		Yii::app()->user->logout();
		$callback['success'] = true;
		echo json_encode($callback);	
	}
	
}