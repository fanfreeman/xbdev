<?php

class m111123_040218_create_follows_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("{{follows}}",
			array("follow_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
				"follower_id"=>"INT UNSIGNED NOT NULL COMMENT '用户id'",
				"following_id"=>"INT UNSIGNED NOT NULL COMMENT '关注人id'",
				"created"=>"INT UNSIGNED NOT NULL COMMENT '添加时间'",
				"PRIMARY KEY (`follow_id`)",
				"UNIQUE INDEX `uid_fid` (`follower_id` ASC, `following_id` ASC)",
			), "ENGINE = MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = '关注列表'");
	}

	public function down()
	{
		$this->dropTable('{{follows}}');
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