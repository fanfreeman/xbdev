<?php

class m120330_055352_update_user_active extends CDbMigration
{
	public function up()
	{
		$this->addColumn('users','active','TINYINT(1) NULL DEFAULT 1'); 
	}

	public function down()
	{
		$this->dropColumn('users','active'); 
	}
}