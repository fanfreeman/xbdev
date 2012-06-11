<?php

class m120321_051401_update_user extends CDbMigration
{
	public function up()
	{
		//echo "users表添加职位、签名、固话、移动电话.\n";
		$this->addColumn('users','position','VARCHAR(127) NULL'); 
		$this->addColumn('users','blurb','VARCHAR(255) NULL'); 
		$this->addColumn('users','telephone','VARCHAR(31) NULL'); 
		$this->addColumn('users','mobile','VARCHAR(31) NULL'); 
	}

	public function down()
	{
		//echo "users表删除职位、签名、固话、移动电话.\n";
		$this->dropColumn('users','position'); 
		$this->dropColumn('users','blurb'); 
		$this->dropColumn('users','telephone'); 
		$this->dropColumn('users','mobile'); 
	}
}