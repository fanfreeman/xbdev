<?php

class m111128_035222_create_feedcomments_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("{{feedcomments}}",
			array("feedcomment_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
				"newsfeed_id"=>"INT UNSIGNED NOT NULL",
				"user_id"=>"INT UNSIGNED NOT NULL COMMENT '用户id'",
				"content"=>"VARCHAR(140) NOT NULL COMMENT '内容'",
				"created"=>"INT UNSIGNED NOT NULL COMMENT '添加时间'",
				"reply_to_id"=>"INT UNSIGNED NOT NULL COMMENT '回复对象用户ID'",
				"PRIMARY KEY (`feedcomment_id`)",
				"INDEX `Fk_user_id` (`user_id` ASC)",
				"INDEX `Fk_reply_to_id` (`reply_to_id` ASC)",
				"INDEX `Fk_newsfeed_id` (`newsfeed_id` ASC)"
			), "ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = 'feeds评论'"
		);
		$this->addForeignKey( 'Fk_comment_user_id',  'feedcomments',  'user_id',  'users',  'user_id',  'CASCADE',  'RESTRICT');
		$this->addForeignKey( 'Fk_comment_reply_to_id',  'feedcomments',  'reply_to_id',  'users',  'user_id',  'CASCADE',  'RESTRICT');
		$this->addForeignKey( 'Fk_comment_newsfeed_id',  'feedcomments',  'newsfeed_id',  'newsfeeds',  'newsfeed_id',  'CASCADE',  'RESTRICT');

	}

	public function down()
	{
		$this->dropForeignKey( 'Fk_comment_user_id',  'feedcomments');
		$this->dropForeignKey( 'Fk_comment_reply_to_id',  'feedcomments');
		$this->dropForeignKey( 'Fk_comment_newsfeed_id',  'feedcomments');
		$this->dropTable("{{feedcomments}}");
	}

	/*
	CREATE  TABLE IF NOT EXISTS `atom`.`feedcomments` (
  `newsfeed_comment_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `newsfeed_id` INT UNSIGNED NOT NULL ,
  `user_id` INT UNSIGNED NOT NULL COMMENT '用户id' ,
  `content` VARCHAR(140) NOT NULL COMMENT '内容' ,
  `created` INT UNSIGNED NOT NULL COMMENT '添加时间' ,
  `reply_to_id` INT UNSIGNED NOT NULL COMMENT '回复对象用户ID' ,
  PRIMARY KEY (`newsfeed_comment_id`) ,
  INDEX `Fk_user_id` (`user_id` ASC) ,
  INDEX `Fk_reply_to_id` (`reply_to_id` ASC) ,
  INDEX `Fk_newsfeed_id` (`newsfeed_id` ASC) ,
  CONSTRAINT `Fk_user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `atom`.`users` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE RESTRICT,
  CONSTRAINT `Fk_reply_to_id`
    FOREIGN KEY (`reply_to_id` )
    REFERENCES `atom`.`users` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE RESTRICT,
  CONSTRAINT `Fk_newsfeed_id`
    FOREIGN KEY (`newsfeed_id` )
    REFERENCES `atom`.`newsfeeds` (`newsfeed_id` )
    ON DELETE CASCADE
    ON UPDATE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'feeds评论'
	*/
}