<?php
/**
 * This class provides all methods for user management.
 *
 * Hooks provided:
 *   pre_createUser(&run, uid, password)
 *   post_createUser(uid, password)
 *   pre_deleteUser(&run, uid)
 *   post_deleteUser(uid)
 *   pre_setPassword(&run, uid, password)
 *   post_setPassword(uid, password)
 *   pre_login(&run, uid)
 *   post_login(uid)
 *   logout()
 */
class Atom_User {
	/**
	 * @brief Create a new user
	 * @param $uid The username of the user to create
	 * @param $password The password of the new user
	 * @returns true/false
	 *
	 * Creates a new user. Basic checking of username is done in Atom_User
	 * itself, not in its subclasses.
	 *
	 * Allowed characters in the username are: "a-z", "A-Z", "0-9" and "_.@-"
	 */
	public static function createUser( $uid, $password ){
		// Check the name for bad characters
		// Allowed are: "a-z", "A-Z", "0-9" and "_.@-"
		if( preg_match( '/[^a-zA-Z0-9 _\.@\-]/', $uid )){
			return false;
		}
		// No empty username
		if( !$uid ){
			return false;
		}
		// Check if user already exists
		if( self::userExists($uid) ){
			return false;
		}


		$run = true;
		Atom_Hook::emit( "Atom_User", "pre_createUser", array( "run" => &$run, "uid" => $uid, "password" => $password ));

		if( $run ){
			//create the user in the first backend that supports creating users
			foreach(self::$_usedBackends as $backend){
				if(!$backend->implementsActions(Atom_USER_BACKEND_CREATE_USER))
					continue;

				$backend->createUser($uid,$password);
				Atom_Hook::emit( "Atom_User", "post_createUser", array( "uid" => $uid, "password" => $password ));

				return true;
			}
		}
		return false;
	}

	/**
	 * @brief delete a user
	 * @param $uid The username of the user to delete
	 * @returns true/false
	 *
	 * Deletes a user
	 */
	public static function deleteUser( $uid ){
		$run = true;
		Atom_Hook::emit( "Atom_User", "pre_deleteUser", array( "run" => &$run, "uid" => $uid ));

		if( $run ){
			//delete the user from all backends
			foreach(self::$_usedBackends as $backend){
				if($backend->implementsActions(Atom_USER_BACKEND_DELETE_USER)){
					$backend->deleteUser($uid);
				}
			}
			// We have to delete the user from all groups
			foreach( Atom_Group::getUserGroups( $uid ) as $i ){
				Atom_Group::removeFromGroup( $uid, $i );
			}

			// Emit and exit
			Atom_Hook::emit( "Atom_User", "post_deleteUser", array( "uid" => $uid ));
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * @brief Try to login a user
	 * @param $uid The username of the user to log in
	 * @param $password The password of the user
	 * @returns true/false
	 *
	 * Log in a user - if the password is ok
	 */
	public static function login( $uid, $password ){
		$run = true;
		
		Atom_Hook::emit( "Atom_User", "pre_login", array( "run" => &$run, "uid" => $uid ));

		if( $run ){
			
			$uid=self::checkPassword( $uid, $password );
			
			if($uid){
				//Atom_Crypt::init($uid,$password);
				return self::setUserId($uid);
			}
		}
		return false;
	}

	/**
	 * @brief Sets user id for session and triggers emit
	 * @returns true
	 *
	 */
	public static function setUserId($uid) {
		$_SESSION['user_id'] = $uid;
		Atom_Hook::emit( "Atom_User", "post_login", array( "uid" => $uid ));
		return true;
	}

	/**
	 * @brief Kick the user
	 * @returns true
	 *
	 * Logout, destroys session
	 */
	public static function logout(){
		Atom_Hook::emit( "Atom_User", "logout", array());
		$_SESSION['user_id'] = false;
		Atom_User::unsetMagicInCookie();
		return true;
	}

	/**
	 * @brief Check if the user is logged in
	 * @returns true/false
	 *
	 * Checks if the user is logged in
	 */
	public static function isLoggedIn(){
		if( isset($_SESSION['user_id']) AND $_SESSION['user_id'] ){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * @brief get the user idea of the user currently logged in.
	 * @return string uid or false
	 */
	public static function getUser(){
		if( isset($_SESSION['user_id']) AND $_SESSION['user_id'] ){
			return $_SESSION['user_id'];
		}
		else{
			return false;
		}
	}

	/**
	 * @brief Autogenerate a password
	 * @returns string
	 *
	 * generates a password
	 */
	public static function generatePassword(){
		return uniqId();
	}

	/**
	 * @brief Set password
	 * @param $uid The username
	 * @param $password The new password
	 * @returns true/false
	 *
	 * Change the password of a user
	 */
	public static function setPassword( $uid, $password ){
		$run = true;
		Atom_Hook::emit( "Atom_User", "pre_setPassword", array( "run" => &$run, "uid" => $uid, "password" => $password ));

		if( $run ){
			foreach(self::$_usedBackends as $backend){
				if($backend->implementsActions(Atom_USER_BACKEND_SET_PASSWORD)){
					if($backend->userExists($uid)){
						$backend->setPassword($uid,$password);
					}
				}
			}
			Atom_Hook::emit( "Atom_User", "post_setPassword", array( "uid" => $uid, "password" => $password ));
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * @brief Check if the password is correct
	 * @param $uid The username
	 * @param $password The password
	 * @returns true/false
	 *
	 * Check if the password is correct without logging in the user
	 */
	public static function checkPassword( $uid, $password ){
		
		$objAtomUserDb = new Atom_User_Database();
		
		$result = $objAtomUserDb->checkPassword( $uid, $password );
		
		return $result;
	}

	/**
	 * @brief Get a list of all users
	 * @returns array with all uids
	 *
	 * Get a list of all users.
	 */
	public static function getUsers(){
		$users=array();
		foreach(self::$_usedBackends as $backend){
			if($backend->implementsActions(Atom_USER_BACKEND_GET_USERS)){
				$users=array_merge($users,$backend->getUsers());
			}
		}
		return $users;
	}

	/**
	 * @brief check if a user exists
	 * @param string $uid the username
	 * @return boolean
	 */
	public static function userExists($uid){
		foreach(self::$_usedBackends as $backend){
			if($backend->implementsActions(Atom_USER_BACKEND_USER_EXISTS)){
				$result=$backend->userExists($uid);
				if($result===true){
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * @brief Set cookie value to use in next page load
	 * @param string $username username to be set
	 */
	public static function setMagicInCookie($username, $token){
		$secure_cookie = Atom_Config::getValue("forcessl", false);
		setcookie("atom_username", $username, time()+60*60*24*15, '', '', $secure_cookie);
		setcookie("atom_token", $token, time()+60*60*24*15, '', '', $secure_cookie);
		setcookie("atom_remember_login", true, time()+60*60*24*15, '', '', $secure_cookie);
	}

	/**
	 * @brief Remove cookie for "remember username"
	 */
	public static function unsetMagicInCookie(){
		unset($_COOKIE["atom_username"]);
		unset($_COOKIE["atom_token"]);
		unset($_COOKIE["atom_remember_login"]);
		setcookie("atom_username", NULL, -1);
		setcookie("atom_token", NULL, -1);
		setcookie("atom_remember_login", NULL, -1);
	}
}
