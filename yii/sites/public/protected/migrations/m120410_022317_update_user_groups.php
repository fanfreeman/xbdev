<?php

class m120410_022317_update_user_groups extends CDbMigration
{
	public function up()
	{
		$this->addColumn('users','company','INT UNSIGNED NULL'); 
		$this->addColumn('users','department','INT UNSIGNED NULL');
		$this->alterColumn('users','position',"INT UNSIGNED NULL"); 
		
		$this->update('users', array('position'=>NULL));
		
		$this->addForeignKey( 'FK_company_group',  'users',  'company',  'groups',  'group_id',  'CASCADE',  'RESTRICT');
		$this->addForeignKey( 'FK_department_group',  'users',  'department',  'groups',  'group_id',  'CASCADE',  'RESTRICT');
		$this->addForeignKey( 'Fk_position_group',  'users',  'position',  'groups',  'group_id',  'CASCADE',  'RESTRICT');
	}

	public function down()
	{
		$this->dropForeignKey( 'FK_company_group',  'users');
		$this->dropForeignKey( 'FK_department_group',  'users');
		$this->dropForeignKey( 'Fk_position_group',  'users');
		
		$this->dropColumn('users','company'); 
		$this->dropColumn('users','department'); 
		$this->alterColumn('users','position',"varchar(127) DEFAULT NULL"); 
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
  `avatar` VARCHAR(255) NULL DEFAULT '/images/peoplePic01.png' ,
  `ping` INT UNSIGNED NULL ,
  `company` INT UNSIGNED NULL ,
  `department` INT UNSIGNED NULL ,
  `position` INT UNSIGNED NULL ,
  `blurb` VARCHAR(255) NULL ,
  `telephone` VARCHAR(31) NULL ,
  `mobile` VARCHAR(31) NULL ,
  `active` TINYINT(1) NULL DEFAULT 1 ,
  PRIMARY KEY (`user_id`) ,
  INDEX `email` (`email` ASC) ,
  INDEX `FK_company_group` (`company` ASC) ,
  INDEX `FK_department_group` (`department` ASC) ,
  INDEX `Fk_position_group` (`position` ASC) ,
  CONSTRAINT `FK_company_group`
    FOREIGN KEY (`company` )
    REFERENCES `atom`.`groups` (`group_id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_department_group`
    FOREIGN KEY (`department` )
    REFERENCES `atom`.`groups` (`group_id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `Fk_position_group`
    FOREIGN KEY (`position` )
    REFERENCES `atom`.`groups` (`group_id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = '用户表'
	*/
}