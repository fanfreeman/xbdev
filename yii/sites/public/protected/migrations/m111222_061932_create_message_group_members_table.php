<?php

class m111222_061932_create_message_group_members_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("{{message_group_members}}",
			array("message_group_member_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
  				"message_group_id"=>"INT UNSIGNED NOT NULL",
  				"user_id"=>"INT UNSIGNED NOT NULL",
				"other_members"=>"VARCHAR(45) NOT NULL",
				"last_message_id"=>"INT UNSIGNED NOT NULL DEFAULT 0",
  				"is_read"=>"TINYINT(1) NOT NULL DEFAULT 1",
  				"PRIMARY KEY (`message_group_member_id`)"
  			), "ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci"
  		);
		$this->addForeignKey( 'FK_messages_groupID',  'messages',  'message_group_id',  'message_groups',  'message_group_id',  'CASCADE',  'RESTRICT');
		$this->addForeignKey( 'FK_message_group_members_groupID',  'message_group_members',  'message_group_id',  'message_groups',  'message_group_id',  'CASCADE',  'RESTRICT');
		$this->addForeignKey('FK_messages_userID','messages','sender_id', 'users',  'user_id',  'CASCADE',  'RESTRICT');
		$this->addForeignKey( 'FK_message_group_members_userID',  'message_group_members',  'user_id',  'users',  'user_id',  'CASCADE',  'RESTRICT');
		
	}

	public function down()
	{
		$this->dropForeignKey( 'FK_messages_groupID',  'messages');
		$this->dropForeignKey( 'FK_message_group_members_groupID',  'message_group_members');
		$this->dropForeignKey( 'FK_messages_userID',  'messages');
		$this->dropForeignKey( 'FK_message_group_members_userID',  'message_group_members');
		$this->dropTable("{{message_group_members}}");
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