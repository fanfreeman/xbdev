<?php

class m111206_065103_create_groups_table extends CDbMigration
{
	public function up()
	{
        $this->createTable("{{groups}}",
            array("group_id" => "INT UNSIGNED NOT NULL AUTO_INCREMENT",
                "name" => "VARCHAR(45) NOT NULL",
                "description" => "VARCHAR(140) NOT NULL COMMENT '描述'",
                "type" => "TINYINT UNSIGNED NOT NULL COMMENT '0 开放 1 私密(可搜索) 2 隐藏(私密,不可搜索)'",
                "created" => "INT UNSIGNED NOT NULL COMMENT '添加时间'",
                "PRIMARY KEY (`group_id`)"
            ), "ENGINE = MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = '群组'" 
        );

	}

	public function down()
	{
		$this->dropTable("{{groups}}");
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