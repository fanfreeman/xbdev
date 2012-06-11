<?php

class m111221_045412_create_likes_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{likes}}',
			array ("like_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
  				"user_id"=>"INT UNSIGNED NOT NULL COMMENT '用户id'",
  				"resource_id"=>"INT UNSIGNED NOT NULL COMMENT '资源id'",
  				"resource_type"=>"VARCHAR(45) NOT NULL COMMENT '类型'",
  				"created"=>"INT UNSIGNED NOT NULL COMMENT '添加时间'",
  				"PRIMARY KEY (`like_id`)",
  				"INDEX `user_id` (`user_id` ASC)"
  			), "ENGINE = MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = '用户喜欢'"
  		); 
	}

	public function down()
	{
		$this->dropTable("{{likes}}");
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