<?php

class m120325_044808_create_tbl_user_skills extends CDbMigration
{
	public function up()
	{
		$this->createTable("{{user_skills}}",
			array("user_skill_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
  				"user_id"=>"INT UNSIGNED NOT NULL COMMENT '用户id'",
  				"skill_id"=>"INT UNSIGNED NOT NULL COMMENT '技能id'",
  				"PRIMARY KEY (`user_skill_id`)",
  			),"ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = '用户技能关系表' "
  		);
		$this->addForeignKey( 'Fk_user_id',  'user_skills',  'user_id',  'users',  'user_id',  'CASCADE',  'RESTRICT');
		$this->addForeignKey( 'Fk_skill_id',  'user_skills',  'skill_id',  'skills',  'skill_id',  'CASCADE',  'RESTRICT');
	}

	public function down()
	{
		$this->dropForeignKey( 'Fk_user_id',  'user_skills');
		$this->dropForeignKey( 'Fk_skill_id',  'user_skills');
		$this->dropTable("{{user_skills}}");
	}

	/*
	CREATE  TABLE IF NOT EXISTS `atom`.`user_skills` (
	  `user_skill_id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户id' ,
	  `user_id` INT UNSIGNED NOT NULL ,
	  `skill_id` INT UNSIGNED NOT NULL ,
	  PRIMARY KEY (`user_skill_id`) ,
	  INDEX `skill` () ,
	  INDEX `Fk_user_id` (`user_id` ASC) ,
	  INDEX `Fk_skill_id` (`skill_id` ASC) ,
	  CONSTRAINT `Fk_user_id`
		FOREIGN KEY (`user_id` )
		REFERENCES `atom`.`users` (`user_id` )
		ON DELETE NO ACTION
		ON UPDATE NO ACTION,
	  CONSTRAINT `Fk_skill_id`
		FOREIGN KEY (`skill_id` )
		REFERENCES `atom`.`skills` (`skill_id` )
		ON DELETE NO ACTION
		ON UPDATE NO ACTION)
	ENGINE = InnoDB
	DEFAULT CHARACTER SET = utf8
	COLLATE = utf8_general_ci
	COMMENT = '用户表'
	*/
}