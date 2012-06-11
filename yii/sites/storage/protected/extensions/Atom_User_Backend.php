<?php
/**
 * error code for functions not provided by the user backend
 */
define('Atom_USER_BACKEND_NOT_IMPLEMENTED',   -501);

/**
 * actions that user backends can define
 */
define('Atom_USER_BACKEND_CREATE_USER',       0x000001);
define('Atom_USER_BACKEND_DELETE_USER',       0x000010);
define('Atom_USER_BACKEND_SET_PASSWORD',      0x000100);
define('Atom_USER_BACKEND_CHECK_PASSWORD',    0x001000);
define('Atom_USER_BACKEND_GET_USERS',         0x010000);
define('Atom_USER_BACKEND_USER_EXISTS',       0x100000);


/**
 * abstract base class for user management
 * subclass this for your own backends and see Atom_User_Example for descriptions
 */
abstract class Atom_User_Backend {

	protected $possibleActions = array(
		Atom_USER_BACKEND_CREATE_USER => 'createUser',
		Atom_USER_BACKEND_DELETE_USER => 'deleteUser',
		Atom_USER_BACKEND_SET_PASSWORD => 'setPassword',
		Atom_USER_BACKEND_CHECK_PASSWORD => 'checkPassword',
		Atom_USER_BACKEND_GET_USERS => 'getUsers',
		Atom_USER_BACKEND_USER_EXISTS => 'userExists'
	);

	/**
	* @brief Get all supported actions
	* @returns bitwise-or'ed actions
	*
	* Returns the supported actions as int to be
	* compared with Atom_USER_BACKEND_CREATE_USER etc.
	*/
	public function getSupportedActions(){
		$actions = 0;
		foreach($this->possibleActions AS $action => $methodName){
			if(method_exists($this, $methodName)) {
				$actions |= $action;
			}
		}

		return $actions;
	}

	/**
	* @brief Check if backend implements actions
	* @param $actions bitwise-or'ed actions
	* @returns boolean
	*
	* Returns the supported actions as int to be
	* compared with Atom_USER_BACKEND_CREATE_USER etc.
	*/
	public function implementsActions($actions){
		return (bool)($this->getSupportedActions() & $actions);
	}
}
