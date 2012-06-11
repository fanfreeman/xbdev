<?php

class m120410_021531_create_new_groups extends CDbMigration
{
	public function up()
	{
		$this->createTable("{{groups}}",
			array("group_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
					"name"=>"VARCHAR(45) NOT NULL COMMENT '用户id'",
					"description"=>"VARCHAR(140) NOT NULL COMMENT '描述'",
					"type"=>"TINYINT UNSIGNED NOT NULL COMMENT '0 开放 1 私密(可搜索) 2 隐藏(私密,不可搜索)'",
					"created"=>"INT UNSIGNED NOT NULL COMMENT '添加时间'",
					"father_id"=>"INT UNSIGNED NOT NULL",
					"PRIMARY KEY (`group_id`)",
				),"ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = '群组' "
			);
	}

	public function down()
	{
		$this->dropTable("{{groups}}");
	}

	/*
	CREATE  TABLE IF NOT EXISTS `atom`.`groups` (
	  `group_id` INT UNSIGNED NOT NULL ,
	  `name` VARCHAR(45) NOT NULL ,
	  `description` VARCHAR(140) NOT NULL COMMENT '描述' ,
	  `type` TINYINT UNSIGNED NOT NULL COMMENT '0 开放 1 私密(可搜索) 2 隐藏(私密,不可搜索)' ,
	  `created` INT UNSIGNED NOT NULL COMMENT '添加时间' ,
	  `father_id` INT UNSIGNED NOT NULL ,
	  PRIMARY KEY (`group_id`) )
	ENGINE = InnoDB
	DEFAULT CHARACTER SET = utf8
	COLLATE = utf8_general_ci
	COMMENT = '群组'
	*/
}