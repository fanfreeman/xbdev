<?php

class m120325_044756_create_tbl_skills extends CDbMigration
{
	public function up()
	{
		$this->createTable("{{skills}}",
			array("skill_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
					"skill"=>"VARCHAR(50) NOT NULL COMMENT '技能名称'",
  					"created"=>"INT UNSIGNED NOT NULL",
  					"PRIMARY KEY (`skill_id`)"
  					),"ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = '技能表' "
  		);
	}

	public function down()
	{
		$this->dropTable("{{skills}}");
	}

	/*
	CREATE  TABLE IF NOT EXISTS `atom`.`skills` (
	  `skill_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户id' ,
	  `skill` VARCHAR(50) NOT NULL ,
	  `created` INT UNSIGNED NOT NULL ,
	  PRIMARY KEY (`skill_id`) ,
	  INDEX `skill` () )
	ENGINE = InnoDB
	DEFAULT CHARACTER SET = utf8
	COLLATE = utf8_general_ci
	COMMENT = '用户表'
	*/
}