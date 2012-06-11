<?php
class NotificationsController extends CController
{
	public function actions()
    {
        return array(
            'index'=>array(
                'class'=>'CWebServiceAction',
            ),
        );
    }

    /**
     * 
     * @param int user_id
     * @param int resource_id
     * @param string resource_type
     * @return mixed success
     * @soap
     */
    public function add($intUser_id, $intResource_id, $strResource_type)
    {
    	try {
            $intUser_id = intval($intUser_id);
            $intResource_id = intval($intResource_id);
            $strResource_type = strval($strResource_type);
            if (empty($intUser_id) || empty($intResource_id) || empty($strResource_type)) {
                throw new Exception("empty user_id strResource_type or intResource_id", 1);
            }
            if (!$user_info = bizUser::getInfo(array('user_id'=>$intUser_id))) {
                throw new Exception("Notifications user not exist", 1);
            }

            if (!$result = bizNotifications::add($intFollowerId, $intFollowingId, $resource_type)) {
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
     * 
     * @param int user_id
     * @param int notification_id
     * @soap
     */
    public function delete($intUser_id, $intNotification_id)
    {
    	try {
            $intUser_id = intval($intUser_id);
            $intNotification_id = intval($intNotification_id);
            if (empty($intUser_id) || empty($intNotification_id)) {
                throw new Exception("empty user_id or Notification_id", 1);
            }
            if (!$user_info = bizUser::getInfo(array('user_id'=>$intUser_id))) {
                throw new Exception("Notifications user not exist", 1);
            }

            if (!$result = bizNotifications::delete($intFollowerId, $intNotification_id)) {
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
     * 
     * @param int user_id
     * @return mixed success
     * @soap
     */
    public function getList($intUserId)
    {
    	try {
            $intUserId = intval($intUserId);
            if (empty($intUserId)) {
                throw new Exception("empty user_id", 1);
            }
            if (!$user_info = bizUser::getInfo(array('user_id'=>$intUserId))) {
                throw new Exception("folloer user not exist", 1);
            }

            if (!$result = bizNotifications::getList($intUserId)) {
                throw new Exception("model error", 1);
            }
        } catch (Exception $e) {
            return  array(
                'error' => $e->getMessage(),
            );
        }
        
        return $result;
    }
}