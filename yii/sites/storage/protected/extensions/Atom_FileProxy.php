<?php
/**
 * Class for manipulating filesystem requests
 *
 * Manipulation happens by using 2 kinds of proxy operations, pre and post proxies
 * that manipulate the filesystem call and the result of the call respectively
 *
 * A pre-proxy recieves the filepath as arugments (or 2 filepaths in case of operations like copy or move) and return a boolean
 * If a pre-proxy returnes false the file operation will be canceled
 * All filesystem operations have a pre-proxy
 *
 * A post-proxy receives 2 arguments, the filepath and the result of the operation.
 * The return value of the post-proxy will be used as the new result of the operation
 * The operations that have a post-proxy are
 *      file_get_contents, is_file, is_dir, file_exists, stat, is_readable, is_writable, fileatime, filemtime, filectime, getMimeType, hash, free_space and search
 */

class Atom_FileProxy{
	private static $proxies=array();
	
	/**
	 * check if this proxy implments a specific proxy operation
	 * @param string $operation name of the proxy operation
	 * @return bool
	 */
	public function provides($operation){
		return method_exists($this,$operation);
	}
	
	/**
	 * fallback function when a proxy operation is not implement
	 * @param string $function the name of the proxy operation
	 * @param mixed
	 *
	 * this implements a dummy proxy for all operations
	 */
	public function __call($function,$arguments){
		if(substr($function,0,3)=='pre'){
			return true;
		}else{
			return $arguments[1];
		}
	}
	
	/**
	 * register a proxy to be used
	 * @param Atom_FileProxy $proxy
	 */
	public static function register($proxy){
		self::$proxies[]=$proxy;
	}
	
	/**
	 * @param $post 
	 * @param unknown_type $operation
	 * @param bool $post whether the operation is a post proxy
	 */
	public static function getProxies($operation,$post){
		$operation=(($post)?'post':'pre').$operation;
		$proxies=array();
		foreach(self::$proxies as $proxy){
			if($proxy->provides($operation)){
				$proxies[]=$proxy;
			}
		}
		return $proxies;
	}

	public static function runPreProxies($operation,$filepath,$filepath2=null){
		$proxies=self::getProxies($operation,false);
		$operation='pre'.$operation;
		foreach($proxies as $proxy){
			if($filepath2){
				if(!$proxy->$operation($filepath,$filepath2)){
					return false;
				}
			}else{
				if(!$proxy->$operation($filepath)){
					return false;
				}
			}
		}
		return true;
	}

	public static function runPostProxies($operation,$path,$result){
		$proxies=self::getProxies($operation,true);
		$operation='post'.$operation;
		foreach($proxies as $proxy){
			$result=$proxy->$operation($path,$result);
		}
		return $result;
	}
}