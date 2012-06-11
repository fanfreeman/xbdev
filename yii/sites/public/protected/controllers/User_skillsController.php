<?php

class User_skillsController extends Controller
{
	public function actionupdateUserInfo()
	{
		$columType = $_POST['columType'];
		$columVal = $_POST['columVal'];
		
		$objatomUser = new AtomUsers();
		$id_user = Yii::app()->user->id;
		
		if ($objatomUser->updateByPk($id_user, array($columType=>$columVal)))
		{
			$callback['success'] = true;	
		}
		else
		{
			$callback['success'] = false;	
			$callback['error'] = 'cant save '.$columType;	
		}
		echo json_encode($callback);
	}
}