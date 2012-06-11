<?php

class m111123_041129_create_newsfeeds_table extends CDbMigration
{
	public function up()
	{
		$this->createTable("{{newsfeeds}}",
			array("newsfeed_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
				"user_id"=>"INT UNSIGNED NOT NULL COMMENT '用户id'",
				"group_id"=>"INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '所属群组Id,默认为0,即默认公司群组'",
				"resource_id"=>"INT UNSIGNED NOT NULL COMMENT '资源id'",
				"resource_type"=>"VARCHAR(45) NOT NULL COMMENT '类型'",
				"params"=>"TEXT NOT NULL COMMENT '内容'",
				"created"=>"INT UNSIGNED NOT NULL COMMENT '添加时间'",
				"updated"=>"INT UNSIGNED NOT NULL COMMENT '更新操作,用户资源被操作后'",
				"PRIMARY KEY (`newsfeed_id`)",
				"INDEX `user_id` (`user_id` ASC)",
				"INDEX `group_id` (`group_id` ASC)",
				"INDEX `Fk_user_id` (`user_id` ASC)"
			), "ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = '用户新鲜事'");
		$this->addForeignKey( 'Fk_newsfeed_user_id',  'newsfeeds',  'user_id',  'users',  'user_id',  'CASCADE',  'RESTRICT');
	}

	public function down()
	{
		$this->dropForeignKey( 'Fk_newsfeed_user_id',  'newsfeeds');
		$this->dropTable('{{newsfeeds}}');
	}

	/*
	CREATE  TABLE IF NOT EXISTS `atom`.`newsfeeds` (
  `newsfeed_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` INT UNSIGNED NOT NULL COMMENT '用户id' ,
  `group_id` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '所属群组Id,默认为0,即默认公司群组' ,
  `resource_id` INT UNSIGNED NOT NULL COMMENT '资源id' ,
  `resource_type` VARCHAR(45) NOT NULL COMMENT '类型' ,
  `params` TEXT NOT NULL COMMENT '内容' ,
  `created` INT UNSIGNED NOT NULL COMMENT '添加时间' ,
  `updated` INT UNSIGNED NOT NULL COMMENT '更新操作,用户资源被操作后' ,
  PRIMARY KEY (`newsfeed_id`) ,
  INDEX `user_id` (`user_id` ASC) ,
  INDEX `group_id` (`group_id` ASC) ,
  INDEX `Fk_user_id` (`user_id` ASC) ,
  CONSTRAINT `Fk_user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `atom`.`users` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '用户新鲜事'
	*/
}