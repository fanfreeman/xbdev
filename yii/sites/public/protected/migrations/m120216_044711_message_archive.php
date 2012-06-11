<?php

class m120216_044711_message_archive extends CDbMigration
{
	public function up()
	{
		$this->createTable("{{message_archive}}",
			array("message_archive_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
  				"message_id"=>"INT UNSIGNED NOT NULL",
  				"sender_id"=>"INT UNSIGNED NOT NULL",
				"reciver_id"=>"INT UNSIGNED NOT NULL",
				"all_members"=>"VARCHAR(45) NOT NULL",
				"created"=>"INT UNSIGNED NOT NULL",
  				"PRIMARY KEY (`message_archive_id`)"
  			), "ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = '消息记录表'"
  		);
		$this->addForeignKey( 'FK_message_archive_message_id',  'message_archive',  'message_id',  'messages',  'message_id',  'CASCADE',  'RESTRICT');
		$this->addForeignKey( 'FK_message_archive_sender_id',  'message_archive',  'sender_id',  'users',  'user_id',  'CASCADE',  'RESTRICT');
		$this->addForeignKey('FK_message_reciver_id','message_archive','reciver_id', 'users',  'user_id',  'CASCADE',  'RESTRICT');
	}

	public function down()
	{
		$this->dropForeignKey( 'FK_message_archive_message_id',  'message_archive');
		$this->dropForeignKey( 'FK_message_archive_sender_id',  'message_archive');
		$this->dropForeignKey( 'FK_message_reciver_id',  'message_archive');
		$this->dropTable("{{message_archive}}");
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