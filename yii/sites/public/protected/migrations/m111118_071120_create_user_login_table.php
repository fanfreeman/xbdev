<?php

class m111118_071120_create_user_login_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("{{user_login}}",
			array("user_login_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
				"user_id"=>"INT UNSIGNED NOT NULL COMMENT '用户id'",
				"publickey"=>"VARCHAR(32) NOT NULL COMMENT 'public key'",
				"privatekey"=>"VARCHAR(32) NOT NULL COMMENT 'private key'",
				"created"=>"INT UNSIGNED NOT NULL",
				"accessed"=>"INT UNSIGNED NOT NULL COMMENT '登录时间'",
				"PRIMARY KEY (`user_login_id`)",
				"UNIQUE INDEX `user` (`user_id` ASC, `privatekey` ASC)",
			),"ENGINE = MyISAM COMMENT = '登录历史'"
		);
	}

	public function down()
	{
        $this->dropTable('{{user_login}}');
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