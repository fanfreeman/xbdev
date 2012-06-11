<?php

class m111118_065651_create_users_table extends CDbMigration
{
	public function up()
	{
	    $this->createTable("{{users}}",
			array("user_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户id'",
					"firstname"=>"VARCHAR(45) NOT NULL",
					"lastname"=>"VARCHAR(255) NOT NULL",
					"password"=>"VARCHAR(255) NOT NULL COMMENT '用户密码'",
					"email"=>"VARCHAR(80) NOT NULL COMMENT '用户email'",
					"created"=>"INT UNSIGNED NOT NULL COMMENT '注册时间'",
					"updated"=>"INT UNSIGNED NOT NULL COMMENT '更新时间'",
					"onlinetime"=>"INT UNSIGNED NOT NULL COMMENT '在线时间'",
					"avatar"=>"VARCHAR(255) NULL",
					"ping"=>"INT UNSIGNED NULL",
					"PRIMARY KEY (`user_id`)",
					"INDEX `email` (`email` ASC)"
  			),"ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = '用户表' "
  		);
	}

	public function down()
	{
        $this->dropTable('{{users}}');
	}

	/*
	CREATE  TABLE IF NOT EXISTS `atom`.`users` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户id' ,
  `firstname` VARCHAR(45) NOT NULL ,
  `lastname` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(255) NOT NULL COMMENT '用户密码' ,
  `email` VARCHAR(80) NOT NULL COMMENT '用户email' ,
  `created` INT UNSIGNED NOT NULL COMMENT '注册时间' ,
  `updated` INT UNSIGNED NOT NULL COMMENT '更新时间' ,
  `onlinetime` INT UNSIGNED NOT NULL COMMENT '在线时间' ,
  `avatar` VARCHAR(255) NULL ,
  `ping` INT UNSIGNED NULL ,
  PRIMARY KEY (`user_id`) ,
  INDEX `email` (`email` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '用户表'
	*/
}
