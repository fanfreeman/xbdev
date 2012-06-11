<?php

class m120228_051933_create_storage_file_permissions_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("{{storage_file_permissions}}",
			array("storage_file_permission_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
				"storage_file_index_id"=>"INT UNSIGNED NOT NULL",
				"user_id"=>"INT UNSIGNED NOT NULL",
				"permissions"=>"INT UNSIGNED NOT NULL",
				"storage_directory_id"=>"INT UNSIGNED NOT NULL DEFAULT 0",
				"PRIMARY KEY (`storage_file_permission_id`)",
				"INDEX `fid` (`storage_file_index_id` ASC)",
				"INDEX `uid` (`user_id` ASC)",
				"UNIQUE INDEX `fid_uid` (`storage_file_index_id` ASC, `user_id` ASC)",
			), "ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = '文件访问权'"
		);
	}

	public function down()
	{
		$this->dropTable("{{storage_file_permissions}}");
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
