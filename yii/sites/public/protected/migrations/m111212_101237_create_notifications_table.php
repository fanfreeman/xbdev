<?php

class m111212_101237_create_notifications_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{notifications}}',
			array ("notification_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
  				"user_id"=>"INT UNSIGNED NOT NULL COMMENT '用户id'",
  				"resource_id"=>"INT UNSIGNED NOT NULL COMMENT '资源id'",
  				"resource_type"=>"VARCHAR(45) NOT NULL COMMENT '类型'",
  				"is_read"=>"TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否已读'",
  				"created"=>"INT UNSIGNED NOT NULL COMMENT '添加时间'",
  				"PRIMARY KEY (`notification_id`)",
  				"INDEX `user_id` (`user_id` ASC)"
  			), "ENGINE = MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = '消息提醒'"
  		); 
	}

	public function down()
	{
		$this->dropTable("{{notifications}}");
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