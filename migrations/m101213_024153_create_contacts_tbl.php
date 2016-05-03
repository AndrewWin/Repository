<?php
	use yii\db\Migration;
	
	class m101213_024153_create_contacts_tbl extends CDbMigration
	{
		public function up()
		{
			$this->createTable('tbl_contacts', array(
				'id' => 'pk',
				'create_date' => 'string',
				'fio' => 'string',
				'number' => 'string',
				'floor' => 'integer',
				'cabinet' => 'integer',
				'status' => 'integer',
			));
		}
	 
		public function down()
		{
			$this->dropTable('tbl_contacts');
		}
	}
?>