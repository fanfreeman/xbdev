<?php

class m120410_083101_update_user_position extends CDbMigration
{
	public function up()
	{
		$this->dropForeignKey( 'FK_company_group',  'users');
		$this->dropForeignKey( 'FK_department_group',  'users');
		$this->dropColumn('users','company'); 
		$this->dropColumn('users','department'); 
	}

	public function down()
	{
		$this->addColumn('users','company','INT UNSIGNED NULL'); 
		$this->addColumn('users','department','INT UNSIGNED NULL');
		$this->addForeignKey( 'FK_company_group',  'users',  'company',  'groups',  'group_id',  'CASCADE',  'RESTRICT');
		$this->addForeignKey( 'FK_department_group',  'users',  'department',  'groups',  'group_id',  'CASCADE',  'RESTRICT');
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