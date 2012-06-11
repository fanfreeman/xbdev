<?php
class bizDirectory
{		
    // interface begin
    // 获取标题
    public static function getListDirectory()
    {
		 $criteria = new CDbCriteria(array(
						'order' => 'created ASC',
						//'limit' => $intCount,
						//'offset' => ($intPage-1)*$intCount,
				));
				
				$objDirectory = new Users;
				$intTotal = $objDirectory->count($criteria);
				$objData = $objDirectory->findAll($criteria);
		
				$arrayData = array();
				foreach($objData as $value) {
					$arrayAttr = $value->getAttributes();
					$arrayData[] = $arrayAttr;
				}
				return array(
					'data' => $arrayData,
					'total' => $intTotal,
				);
	}
	
	public static function countAllDirectory()
	{
		$user_id = Yii::app()->user->id;
		$criteria = new CDbCriteria(array('condition'=>"1=1",));
		$objDirectory = new Users;
		return(count($objDirectory->findAll($criteria)));
	}
	
	public static function getDirectoryByAlphabet($alphabet)
	{
		$user_id = Yii::app()->user->id;
		$objDirectory = new Users;
		$criteria = new CDbCriteria(array('condition'=>"(firstname like '$alphabet%' or firstname like '".strtoupper($alphabet)."%') and user_id!=$user_id", 
				'order'=>'t.firstname ASC',));
		$intTotal = $objDirectory->count($criteria);
		$objData = $objDirectory->findAll($criteria);
		$arrayData = array();
		foreach($objData as $value) {
					$arrayAttr = $value->getAttributes();
					$arrayData[] = $arrayAttr;
				}
		
		return array(
					'data' => $arrayData,
					'total' => $intTotal,
				);
	}

	public static function getAllDirectory($searchType,$searchDirectory)
	{
		$objDirectory = new AtomUsers;
		$criteria = new CDbCriteria(array(
				'condition'=>"active = 1 ", 
				'order'=>'t.firstname ASC',));
		
		switch($searchType)
		{	
			case "searchDirectory":
			if($searchDirectory)
			{
				$array_searchDirectory =explode(" ",$searchDirectory);
				$array_searchDirectory = array_filter(array_unique($array_searchDirectory));
				 foreach ($array_searchDirectory as $searchKey)
				{
					$objUser_skills = new User_skills;
					if ($tag_user_id = $objUser_skills->searchUserByTag($searchKey))
					{
						$str_user_id = implode("','",$tag_user_id);
					$criteria->addCondition('concat(firstname,lastname) like \'%'.$searchKey.'%\' or concat(lastname,firstname) like \'%'.$searchKey.'%\' or firstname like \'%'.$searchKey.'%\' or lastname like \'%'.$searchKey.'%\' or position like \'%'.$searchKey.'%\' or blurb like \'%'.$searchKey.'%\' or user_id in (\''.$str_user_id.'\')','AND');
					}
					else
					{
						$criteria->addCondition('concat(firstname,lastname) like \'%'.$searchKey.'%\' or concat(lastname,firstname) like \'%'.$searchKey.'%\' or firstname like \'%'.$searchKey.'%\' or lastname like \'%'.$searchKey.'%\' or position like \'%'.$searchKey.'%\' or blurb like \'%'.$searchKey.'%\' ','AND');
					}
					//$criteria->addSearchCondition('firstname',$searchKey,true,'OR');
					//$criteria->addInCondition('lastname',$array_searchDirectory,'AND');
				}
			}
			break;
			case "searchSkill_id":
			if($searchDirectory)
			{
				$objUser_skills = new User_skills;
				if ($tag_user_id = $objUser_skills->searchUserBySkill_id($searchDirectory))
				{
					$str_user_id = implode("','",$tag_user_id);
					$criteria->addCondition('user_id in (\''.$str_user_id.'\')','AND');
				}
				else
				{
					$criteria->addCondition('user_id in (\'0\')','AND'); //返回空用户
				}
			}
			break;
			case "searchGroup_id":
				$array_groups = Groups::getGroupsChildren($searchDirectory);
				$criteria->addInCondition('position', $array_groups);
			break;
			
		}
		//
		$intTotal = $objDirectory->count($criteria);
		
		$objData = $objDirectory->findAll($criteria);
		$arrayData = array();
		foreach($objData as $value) {
					$arrayAttr = $value->getAttributes();
					$arrayData[] = $arrayAttr;
				}
		
		return array(
					'data' => $arrayData,
					'total' => $intTotal,
				);
	}	
}

?>
