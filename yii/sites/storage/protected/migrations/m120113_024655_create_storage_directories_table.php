<?php

class m120113_024655_create_storage_directories_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("{{storage_directories}}",
			array("storage_directory_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
				"parent_id"=>"INT UNSIGNED NOT NULL COMMENT '上级目录id'",
				"name"=>"VARCHAR(45) NOT NULL",
				"PRIMARY KEY (`storage_directory_id`)",
				"INDEX `parent_id` (`parent_id` ASC)",
			), "ENGINE = MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = '目录信息'"
		);
	}

	public function down()
	{
		$this->dropTable("{{storage_directories}}");
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