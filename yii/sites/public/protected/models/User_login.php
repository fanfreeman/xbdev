<?php

class User_login extends Model
{
    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }



    /**
     * 删除登陆信息 deleteUserLoginsById($arrayUser_login_id)
     * 通过user登陆信息ID数组 删除相应的记录
     * @return bool 成功返回true 失败返回false
     */
    public function deleteUserLoginsById($arrayUser_login_id)
    {
            $result =  self::model()->deleteAll("user_login_id IN('".implode("' ,'", $arrayUser_login_id)."')");

            return $result;
    }

    /**
     * 删除登陆信息 deleteLoginByIdPublickey($intId, $strPublickey)
     * 通过信息ID 和 publickey 删除一条记录
     * @return bool 成功返回true 失败返回false
     */
    public function deleteLoginByIdPublickey($intId, $strPublickey)
    {
        if(self::model()->deleteAll('user_id=:user_id AND publickey=:publickey', array(':user_id'=>$id, ':publickey'=>$strPublickey)))
            return true;
        else
            return false;
    }

    /**
     * 更新login信息access updateLoginAccessed($intUser_id, $strPrivate_key, $intTime)
     * @return 成功 true 失败 false
     */
    public function updateLoginAccessed($intUser_id, $strPrivate_key, $intTime)
    {
        if (self::model()->updateAll(array('accessed'=>$intTime), 'user_id=:user_id AND privatekey=:privatekey', array(':user_id'=>$intUser_id, ':privatekey'=>$strPrivate_key)))
            return true;
        else
            return false;
    }

    /**
     * 根据用户 ID 和私钥查找登录信息 getLoginByPrivatekey($intUser_id, $strPrivate_key)
     * @return array:返回用户信息数组 失败:空数组
     */
    public function getLoginByPrivatekey($intUser_id, $strPrivate_key)
    {
        if ($info = self::model()->find('user_id=:user_id AND privatekey=:privatekey', array(':user_id'=>$intUser_id, ':privatekey'=>$strPrivate_key), array('limit'=>1)))
            return $info->getAttributes();
         else
            return array();
    }
}