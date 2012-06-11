<?php


class WebUser extends CWebUser {

  const SessionFingerprintSalt = 'my.secret.string';
  const LoginKeySalt = 'another.secret.string';
  const MaxConcurrentLogins = 5;
  private $isUpdateOnlineTime = false;

  /**
   * 用户登陆后设置fingerprint
   */
    protected function afterLogin($fromCookie) {
      $this->setState('fingerprint', $this->getSessionFingerprint());
    }

    protected function beforeLogin($id,$states,$fromCookie)
    {
        $connection = Yii::app()->db;
        $private_key = $this->generatePrivateKey($id);
        $time = time();

        try {
             if ($fromCookie) {// get userid cookie
                $cookie = Yii::app()->getRequest()->getCookies()->itemAt('login');
                if (empty($cookie->value)) {
                    throw new Exception("no cookie[login]", 1);
                }
                list($user_id, $publickey) = explode(':', $cookie->value);
                if (!$user_id || !$publickey) {
                    throw new Exception("cookie[login] wrong format", 1);
                }
                if (!$logininfo = $this->getLoginByPrivatekey($id, $private_key)) {
                    throw new Exception("cant load user login history", 1);
                }
                if ($logininfo['privatekey'] != $private_key) {
                    $this->deleteLoginByIdPublickey($id, $publickey);
                    throw new Exception("privatekey incorrect", 1);
                }
                $this->updateLoginAccessed($id, $private_key, $time);
             } else { // set userid cookie
                if ($logininfo = $this->getLoginByPrivatekey($id, $private_key)) {
                    $publickey = $logininfo['publickey'];
                    $this->updateLoginAccessed($id, $private_key, $time);
                } else {
                    $publickey = md5(rand().microtime());
                    $this->insertLoginPublickey($id, $publickey, $private_key, $time);
                    // flush expired user logins
                    if ($arrLogins = bizUser::loadAllUserLoginById($id)) {
                        if (count($arrLogins) > self::MaxConcurrentLogins) {
                            $this->deleteUserLoginsById(array_slice($arrLogins, self::MaxConcurrentLogins));
                        }
                    }
                }

                $cookie = new CHttpCookie('login', $id.':'.$publickey);
                $cookie->expire = time()+(86400*365);
                Yii::app()->getRequest()->getCookies()->add($cookie->name,$cookie);
            }
        } catch (Exception $e) {
            $this->logout();
            return false;
        }

        return true;
    }

    /**
     * 判断是否是访客(未登陆)
     * @return bool 用户未登录 true, 用户已经登录 false
     */
    public function getIsGuest()
    {
        if (parent::getIsGuest()) {
            return true;
        }
        if ($this->fingerprint != $this->getSessionFingerprint()) {

            $this->logout();
            return true;
        }

        if (!$this->isUpdateOnlineTime) {
             $id = $this->getId();
             // 已经登录, 获取上一次活动时间
             if (!$info = bizUser::getInfo(array('user_id'=>$id))) {
                 $this->logout();
                 return true;
             }
             $onlinetime = $info['onlinetime'];

            //判断活动时间超出则更新online时间
            if (time() - $onlinetime >= (bizUser::UserOnlineTime / 2)) {
                bizUser::update($id, array('onlinetime'=>time()));
            }

            $this->isUpdateOnlineTime = true;
        }

        return false;
    }

    /**
     * 删除登陆信息 deleteUserLoginsById(arrayUser_login_id)
     * 通过user登陆信息ID数组 删除相应的记录
     * @return bool 成功返回true 失败返回false
     */
    protected function deleteUserLoginsById($arrayUser_login_id) {
        $objUser_login = new User_login;
        return $objUser_login->deleteUserLoginsById($arrayUser_login_id);
    }

    /**
     * 通过用户ID和publickey删除用户登录信息deleteLoginByIdPublickey($intUser_id, $strPublickey)
     * @return bool 成功:true 失败:false
     */
    protected function deleteLoginByIdPublickey($intUser_id, $strPublickey)
    {
        $objUser_login = new User_login;
        return $objUser_login->deleteLoginByIdPublickey($intUser_id, $strPublickey);
    }

    /**
     * 插入登陆信息 insertLoginPublickey($intUser_id, $strPublickey, $strPrivate_key, $intTime)
     * @return 成功 true 失败 false
     */
    private function insertLoginPublickey($intUser_id, $strPublickey, $strPrivate_key, $intTime)
    {
        $objLogin = new User_login;
        $objLogin->user_id = $intUser_id;
        $objLogin->publickey = $strPublickey;
        $objLogin->privatekey = $strPrivate_key;
        $objLogin->created = $intTime;
        $objLogin->accessed = $intTime;
        if ($objLogin->save())
            return true;
        else
            return false;
    }

    /**
     * 更新login信息access updateLoginAccessed($intUser_id, $strPrivate_key, $intTime)
     * @return 成功 true 失败 false
     */
    private function updateLoginAccessed($intUser_id, $strPrivate_key, $intTime)
    {
    	/*
        $arrayTime = array('accessed'=>$intTime);
        User_login::model()->updateAll($arrayTime, 'user_id=:user_id AND privatekey=:privatekey', array('user_id'=>$intUser_id, 'privatekey'=>$strPrivate_key));
        */
        $objUser_login = new User_login;
        return $objUser_login->updateLoginAccessed($intUser_id, $strPrivate_key, $intTime);
    }

    /**
     * 根据用户 ID 和私钥查找登录信息 getLoginByPrivatekey($intUser_id, $strPrivate_key)
     * @return array:返回用户信息数组 失败:空数组
     */
    private function getLoginByPrivatekey($intUser_id, $strPrivate_key)
    {
        $objUser_login = new User_login;
        return $objUser_login->getLoginByPrivatekey($intUser_id, $strPrivate_key);
    }

    /**
     * 用户指纹验证码生成
     * @return string 返回当前用户指纹验证码
     */
    public function getSessionFingerprint(){
        return md5(
            self::SessionFingerprintSalt.
            $_SERVER['HTTP_USER_AGENT'].
            session_id()
        );
    }

    /**
     * 用户privatekey生成
     * @return string 返回当前用户privatekey
     */
    private function generatePrivateKey($intUser_id)
    {
        if (@ini_get('browscap')) {
            $objbrowser = get_browser();
            $str = $objbrowser->platform.$objbrowser->parent;
        } else {
            $str = $_SERVER['HTTP_USER_AGENT'];
        }

        return md5($intUser_id.$str.self::LoginKeySalt);
    }

}


?>