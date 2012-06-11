<?php
/**
 * user quota managment
 */

class Atom_FileProxy_Quota extends Atom_FileProxy{
	private function getFreeSpace(){
		$usedSpace=Atom_Filesystem::filesize('');
		$totalSpace=Atom_Preferences::getValue(Atom_User::getUser(),'files','quota',0);
		if($totalSpace==0){
			return 0;
		}
		return $totalSpace-$usedSpace;
	}
	
	public function postFree_space($path,$space){
		$free=$this->getFreeSpace();
		if($free==0){
			return $space;
		}
		return min($free,$space);
	}

	public function preFile_put_contents($path,$data){
		if (is_resource($data)) {
			$data = '';//TODO: find a way to get the length of the stream without emptying it
		}
		return (strlen($data)<$this->getFreeSpace() or $this->getFreeSpace()==0);
	}

	public function preCopy($path1,$path2){
		return (Atom_Filesystem::filesize($path1)<$this->getFreeSpace() or $this->getFreeSpace()==0);
	}

	public function preFromTmpFile($tmpfile,$path){
		return (filesize($tmpfile)<$this->getFreeSpace() or $this->getFreeSpace()==0);
	}

	public function preFromUploadedFile($tmpfile,$path){
		return (filesize($tmpfile)<$this->getFreeSpace() or $this->getFreeSpace()==0);
	}
}