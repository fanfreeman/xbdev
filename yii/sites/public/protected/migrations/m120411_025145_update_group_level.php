<?php

class m120411_025145_update_group_level extends CDbMigration
{
	public function up()
	{
		$this->addColumn('groups','tree_id','INT UNSIGNED NOT NULL DEFAULT 0'); 
		$this->addColumn('groups','tree_level','INT UNSIGNED NOT NULL DEFAULT 1'); 
		$this->dropForeignKey( 'Fk_position_group',  'users');
		
	}

	public function down()
	{
		$this->dropColumn('groups','tree_id'); 
		$this->dropColumn('groups','tree_level'); 
		$this->addForeignKey( 'Fk_position_group',  'users',  'position',  'groups',  'group_id',  'CASCADE',  'RESTRICT');
	}

	/*
	CREATE  TABLE IF NOT EXISTS `atom`.`groups` (
  `group_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(140) NOT NULL COMMENT '描述' ,
  `type` TINYINT UNSIGNED NOT NULL COMMENT '0 开放 1 私密(可搜索) 2 隐藏(私密,不可搜索)' ,
  `created` INT UNSIGNED NOT NULL COMMENT '添加时间' ,
  `father_id` INT UNSIGNED NOT NULL ,
  `tree_id` INT UNSIGNED NOT NULL DEFAULT 0 ,
  `tree_level` INT UNSIGNED NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`group_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '群组'
	*/
}