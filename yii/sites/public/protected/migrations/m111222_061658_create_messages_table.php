<?php

class m111222_061658_create_messages_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("{{messages}}",
			array("message_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
				"type"=>"ENUM('1','2') NOT NULL COMMENT '消息类型：1为用户消息，2为系统消息'",
  				"sender_id"=>"INT UNSIGNED NOT NULL COMMENT '用户id'",
  				"message_group_id"=>"INT UNSIGNED NOT NULL COMMENT '消息群组id'",
  				"message"=>"TEXT NOT NULL COMMENT '消息'",
  				"created"=>"INT UNSIGNED NOT NULL",
  				"PRIMARY KEY (`message_id`)"
  			),"ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = '短消息' "
  		);
		

	}

	public function down()
	{
		$this->dropTable("{{messages}}");
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