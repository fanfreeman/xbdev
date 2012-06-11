<?php


//  $client=new SoapClient('http://hostname/index.php?r=soap/stock');
//  $result =  $client->login($username, $password);

class FollowerController extends CController
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
     * @param string the symbol of the stock
     * @return float the stock price
     * @soap
     */
    public function add($intFollowerId, $intFollowingId)
    {
        try {
            $intFollowerId = intval($intFollowerId);
            $intFollowingId = intval($intFollowingId);
            if (empty($intFollowerId) || empty($intFollowerId)) {
                throw new Exception("empty user_id or following_id", 1);
            }
            if (!$user_info = bizUser::getInfo(array('user_id'=>$intFollowerId))) {
                throw new Exception("folloer user not exist", 1);
            }
            if (!$user_info = bizUser::getInfo(array('user_id'=>$intFollowingId))) {
                throw new Exception("Following user not exist", 1);
            }
            $result = bizFollower::add($intFollowerId, $intFollowingId);

            if (!$result) {
                throw new Exception("model error", 1);
            }
        } catch (Exception $e) {
            return  array(
                'error' => $e->getMessage();
            );
        }

        return $result;
    }
}

?>