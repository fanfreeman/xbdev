<?php

/**
 * UserIdentity represents the data needed to identify a user.
 * It contains the authentication method that checks if the provided
 * data can identify the user.
 */
class UserIdentity extends CUserIdentity
{
    private $user_id = 0;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the email and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
	    $record = Users::model()->findByAttributes(array('email'=>$this->username));

        if ($record === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif (!Password::validate($record->password, $this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->user_id = $record->user_id;
            $states = array('firstname', 'lastname', 'email', 'updated', 'created', 'avatar');
            foreach ($states as $key => $val) {
                $this->setState($val, $record->$val);
            }
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
	}

    public function getId()
    {
        return $this->user_id;
    }
}