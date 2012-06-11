<?php

class Password
{
	const HASH_ALGORITHM = 'sha1';//'SHA-1';
	const SALT_LENGTH = 6;
	const SALT_CHARS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	const FIELD_SEPARATOR = ':';

	static public function validate($strEncryptedPassword, $strRawPassword)
	{
		list($strAlgorithm, $strSalt, $strHashedPassword) = explode(self::FIELD_SEPARATOR, $strEncryptedPassword);
		return $strHashedPassword == self::hash($strAlgorithm, $strSalt, $strRawPassword);
	}

	static public function encrypt($strRawPassword)
	{
		$strSalt = substr(str_shuffle(self::SALT_CHARS), 0, self::SALT_LENGTH);
		return self::HASH_ALGORITHM .self::FIELD_SEPARATOR .$strSalt .self::FIELD_SEPARATOR .self::hash(self::HASH_ALGORITHM, $strSalt, $strRawPassword);
	}

	static protected function hash($strAlgorithm, $strSalt, $strRawPassword)
	{
		$strAlgorithm = strtolower(preg_replace('/\W/', '', $strAlgorithm));
		return hash($strAlgorithm, $strSalt.$strRawPassword);
	}
}

?>