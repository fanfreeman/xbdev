<?php

class m111207_100000_init extends CDbMigration
{
	public function up()
	{
	    $this->createTable("{{storage_file_index}}",
			array("storage_file_index_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
				"unique_id"=>"VARCHAR(42) NOT NULL COMMENT '文件md5值+文件长度'",
				"file_name"=>"VARCHAR(255) NOT NULL COMMENT '文件名称'",
				"directory_id"=>"INT UNSIGNED NOT NULL COMMENT '目录id'",
				"PRIMARY KEY (`storage_file_index_id`)",
				"INDEX `uid_fname` (`unique_id` ASC, `file_name` ASC)",
				"INDEX `directory_id` (`directory_id` ASC)",
			), "ENGINE = MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_bin, COMMENT = '文件索引表'"
		);
		
		$this->createTable("{{storage_path_index}}",
			array("storage_path_index_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
				"unique_id"=>"VARCHAR(42) NOT NULL COMMENT '文件md5值+文件长度'",
				"file_path"=>"VARCHAR(255) NOT NULL COMMENT '文件物理路径'",
				"PRIMARY KEY (`storage_path_index_id`)",
				"UNIQUE INDEX `unique_id_UNIQUE` (`unique_id` ASC)",
			), "ENGINE = MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = '物理存储索引表'"
		);
	}

	public function down()
	{
		$this->dropTable("{{storage_file_index}}");
		$this->dropTable("{{storage_path_index}}");
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