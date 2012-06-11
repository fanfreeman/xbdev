<?php

class m120323_092855_update_users_avatar extends CDbMigration
{
	public function up()
	{
		//echo "修改用户有默认头像";
		$this->alterColumn('users','avatar',"VARCHAR(255) NULL DEFAULT '/images/peoplePic03.png'"); 
	}

	public function down()
	{
		$this->alterColumn('users','avatar',"VARCHAR(255) NULL"); 
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}