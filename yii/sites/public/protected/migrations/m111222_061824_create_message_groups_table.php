<?php

class m111222_061824_create_message_groups_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("{{message_groups}}",
			array("message_group_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
				"all_members"=>"VARCHAR(45) NOT NULL",
				"created"=>"INT UNSIGNED NOT NULL",
  				"PRIMARY KEY (`message_group_id`)"
  			), "ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = 'message 群'"
  		);
	}

	public function down()
	{
		$this->dropTable('{{message_groups}}');
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