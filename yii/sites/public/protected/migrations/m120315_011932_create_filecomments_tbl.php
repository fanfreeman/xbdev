<?php

class m120315_011932_create_filecomments_tbl extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{filecomments}}',
			array ("filecomment_id"=>"INT UNSIGNED NOT NULL AUTO_INCREMENT",
					"storage_file_index_id"=>"INT UNSIGNED NOT NULL",
					"user_id"=>"INT UNSIGNED NOT NULL COMMENT '用户id'",
					"content"=>"VARCHAR(140) NOT NULL COMMENT '内容'",
					"created"=>"INT UNSIGNED NOT NULL COMMENT '添加时间'",
					"PRIMARY KEY (`filecomment_id`)",
				), "ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci, COMMENT = 'files评论'"
  		); 
	}

	public function down()
	{
		$this->dropTable("{{filecomments}}");
	}
}