<?php
	use yii\db\Migration;

	class mm101529_024153_create_user_tbl extends CDbMigration
	{
		public function up()
		{
			$this->createTable('tbl_contacts', array(
				'id' => 'pk',
				'username' => 'string',
				'password' => 'string',
			));
		}
	 
		public function down()
		{
			$this->dropTable('tbl_contacts');
		}
	}
?>