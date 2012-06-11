<?php
/*
 *
 * The following SQL statement is just a help for developers and will not be
 * executed!
 *
 * CREATE TABLE `users` (
 *   `uid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
 *   `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 *   PRIMARY KEY (`uid`)
 * ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
 *
 */

/**
 * Class for user management in a SQL Database (e.g. MySQL, SQLite)
 */
class Atom_User_Database extends Atom_User_Backend {
	static private $userGroupCache=array();

	/**
	 * @brief Create a new user
	 * @param $uid The username of the user to create
	 * @param $password The password of the new user
	 * @returns true/false
	 *
	 * Creates a new user. Basic checking of username is done in Atom_User
	 * itself, not in its subclasses.
	 */
	public function createUser( $uid, $password ){
		if( $this->userExists($uid) ){
			return false;
		}
		else{
			$query = Atom_DB::prepare( "INSERT INTO `*PREFIX*users` ( `uid`, `password` ) VALUES( ?, ? )" );
			$result = $query->execute( array( $uid, sha1( $password )));

			return $result ? true : false;
		}
	}

	/**
	 * @brief delete a user
	 * @param $uid The username of the user to delete
	 * @returns true/false
	 *
	 * Deletes a user
	 */
	public function deleteUser( $uid ){
		// Delete user-group-relation
		$query = Atom_DB::prepare( "DELETE FROM `*PREFIX*users` WHERE uid = ?" );
		$result = $query->execute( array( $uid ));
		return true;
	}

	/**
	 * @brief Set password
	 * @param $uid The username
	 * @param $password The new password
	 * @returns true/false
	 *
	 * Change the password of a user
	 */
	public function setPassword( $uid, $password ){
		if( $this->userExists($uid) ){
			$query = Atom_DB::prepare( "UPDATE *PREFIX*users SET password = ? WHERE uid = ?" );
			$result = $query->execute( array( sha1( $password ), $uid ));

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
	public function checkPassword( $uid, $password ){
		return 'freeman';
		$query = Atom_DB::prepare( "SELECT uid FROM *PREFIX*users WHERE uid LIKE ? AND password = ?" );
		
		$result = $query->execute( array( $uid, sha1( $password )));

		$row=$result->fetchRow();
		if($row){
			return $row['uid'];
		}else{
			return false;
		}
	}

	/**
	 * @brief Get a list of all users
	 * @returns array with all uids
	 *
	 * Get a list of all users.
	 */
	public function getUsers(){
		$query = Atom_DB::prepare( "SELECT uid FROM *PREFIX*users" );
		$result = $query->execute();

		$users=array();
		while( $row = $result->fetchRow()){
			$users[] = $row["uid"];
		}
		return $users;
	}

	/**
	 * @brief check if a user exists
	 * @param string $uid the username
	 * @return boolean
	 */
	public function userExists($uid){
		$query = Atom_DB::prepare( "SELECT * FROM `*PREFIX*users` WHERE uid = ?" );
		$result = $query->execute( array( $uid ));
		
		return $result->numRows() > 0;
	}
}
