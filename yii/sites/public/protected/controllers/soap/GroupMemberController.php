<?php
/**
* 
*/
class GroupMemberController extends Controller
{
	public function actionAbc()
    {
        $client=new SoapClient('http://tingyee.atom.com/index.php?r=soap/groupmember');
        //print_r($client->__getFunctions());die;
        var_dump($client->status(9));
    }

	public function actions()
    {
        return array(
            'index'=>array(
                'class'=>'CWebServiceAction',
            ),
        );
    }

    /**
     * @param int user_id
     * @param int group_id
     * @param int status
     * @param string message
     * @return mixed success
     * @soap
     */
    public function add($intUserId, $intGroupId, $intStatus = 0, $strMessage='')
    {
    	try {
            $intUserId = intval($intUserId);
            $intGroupId = intval($intGroupId);
            $intStatus = intval($intStatus);
            $strMessage = strval($strMessage);

            if (empty($intUserId) || empty($intGroupId)) {
                throw new Exception("empty user_id or following_id", 1);
            }
            if (!$user_info = bizUser::getInfo(array('user_id'=>$intUserId))) {
                throw new Exception("user not exist", 1);
            }
            if ($user_exist = bizGroupMember::exist($intUserId, $intGroupId)) {
                throw new Exception("user exist", 1);
            }
            if (!$result = bizGroupMember::add($intUserId, $intGroupId, $intStatus, $strMessage)) {
                throw new Exception("model error", 1);
            }
        } catch (Exception $e) {

            return  array(
                'error' => $e->getMessage(),
            );
        }
        return $result;
    }

    /**
     * @param int Group_id
     * @return mixed success
     * @soap
     */
    public function delete($intGmId)
    {
    	try {
    		$ingGmId = intval($intGmId);
    		if(empty($intGmId)){
    			throw new Exception("empty intGmId", 1);
    		}
    		if (!$result = bizGroupMember::delete($intGmId)) {
                throw new Exception("model error", 1);
            }
    	} catch (Exception $e) {
    		return  array(
                'error' => $e->getMessage(),
            );
    	}
        return ture;
    }
    
    /**
     * @return mixed Data
     * @soap
     */
    public function getList(){
    	try {
    		if (!$result = bizGroupMember::getList()) {
                throw new Exception("model error", 1);
            }
    	} catch (Exception $e) {
    		return  array(
                'error' => $e->getMessage(),
            );
    	}
        return $resule;
    }

    /**
     * @param int Group_id
     * @return mixed success
     * @soap
     */
    public function status($intGmId){
    	try {
    		$intGmId = intval($intGmId);
    		if(empty($intGmId)){
    			throw new Exception("intGmId empty");
    		}
    		if (!$result = bizGroupMember::status($intGmId)) {
                throw new Exception("model error", 1);
            }
    	} catch (Exception $e) {
    		return  array(
                'error' => $e->getMessage(),
            );
    	}
        return ture;
    }
}