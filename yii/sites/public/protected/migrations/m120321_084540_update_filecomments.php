<?php

class m120321_084540_update_filecomments extends CDbMigration
{
	public function up()
	{
		//echo "修改文件评论TEXT NOT NULL\n";
		$this->alterColumn('filecomments','content','TEXT NOT NULL'); 
		
	}

	public function down()
	{
		//echo "修改文件评论varchar(140)\n";
		$this->alterColumn('filecomments','content','varchar(140)');
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