<?php

class m120214_083656_create_storage_directory_permissions_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("{{storage_directory_permissions}}",
			array("storage_directory_permission_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
				"storage_directory_id"=>"INT UNSIGNED NOT NULL",
				"user_id"=>"INT UNSIGNED NOT NULL",
				"permissions"=>"INT UNSIGNED NOT NULL",
				"PRIMARY KEY (`storage_directory_permission_id`)",
				"INDEX `did` (`storage_directory_id` ASC)",
				"INDEX `uid` (`user_id` ASC)",
				"UNIQUE INDEX `did_uid` (`storage_directory_id` ASC, `user_id` ASC)",
			), "ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = '目录访问权'"
		);
	}

	public function down()
	{
		$this->dropTable("{{storage_directory_permissions}}");
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
