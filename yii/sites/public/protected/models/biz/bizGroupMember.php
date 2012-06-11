<?php
//
class bizGroupMember
{
	/*
	 * This function is add a GroupMember.
	 *
	 *
	 */
	public function add($intUserId, $intGroupId, $intStatus, $strMessage = '')
	{
		if(empty($intUserId) || empty($intGroupId)){
			return false;
		}

		if(self::exist($intUserId, $intGroupId)){
			return false;
		}

		$objGm = new GroupMember;
		$objGm->user_id = $intUserId;
		$objGm->group_id = $intGroupId;
		$objGm->status = $intStatus;
		$objGm->message = $strMessage;
		//echo $intUserId . $intGroupId . $status . $message;
		if(!$objGm->save()){
			//print_r($objGm->getErrors());exit;
			return false;
		}
		return true;
	}

	/*
	 * This function is delete a GroupMember. 
	 *
	 *
	 */
	public function delete($intGmId)
	{
		if(empty($intGmId)){
			return false;
		}

		$objGm = new GroupMember;
		if (!$objGm->deleteByPk($intGmId) > 0) {
			return false;
		}

		return true;

	}

	/*
	 * This function is get GroupMember's List.
	 *
	 *
	 */
	public function getList($page = 1, $count = 20)
	{
		if ($count == 0) {
            $count = 20;
        }

        $objGm = new GroupMember;
        $intNum = $objGm->count();
        $intPagecount = ceil($intNum / $count);

        if($page == $intPagecount){
            $intNext_page = 0;
        }elseif($page > $intPagecount || $page < 1){
            return array(
                'data' => array(),
                'next_page' => 0,
                );
        }else{
            $intNext_page = $page + 1;
        }

        //获取数据
  		$criteria = new CDbCriteria(array(
                  'order' => 'group_member_id',
                  'limit' => $count,
                  'offset' => ($page-1)*$count,
          ));

        $criteria->addCondition("");
        $objData = $objGm->findAll($criteria);

		if (empty($objData)) {
            $arrayData = array();
        }else{
        	foreach($objData as $value) {
        		$arrayData[] = $value->getAttributes();
        	}
        }

		return array(
			'data' => $arrayData,
			'next_page' => $intNext_page,
			);
	}

	/*
	 * This function is update GroupMember's status.
	 *
	 *
	 */
	public function status($intGmId)
	{
		if (empty($intGmId)) {
			return false;
		}

		$objGm = new GroupMember;
		if(!$objGm->updateByPk($intGmId, array('status'=>1))){
			return false;
		}

		return true;
	}

	/*
	 * This function is check user exist.
	 *
	 *
	 */
	public function exist($intUserId, $intGroupId)
	{
		$objGm = new GroupMember;
		if(!$objGm->find('user_id=:user_id and group_id=:group_id', array(':user_id'=>$intUserId, ':group_id'=>$intGroupId))){
			return false;
		}
		return true;
	}
}