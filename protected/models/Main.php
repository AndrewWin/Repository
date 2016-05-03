<?php 

	class Main extends CActiveRecord {		
	
		const WEAK = 0;
		const STRONG = 1;
	
		public static function model($className=__CLASS__)
		{
			return parent::model($className);
		}
	
		public function tableName()
		{
			return '{{contacts}}';
		}
		
		public function rules()
		{
			return array(
				array('fio, number, floor, cabinet', 'required'),
			);
		}
		
		public function getNiceDate()
		{
			return date( 'd.m.Y', $this->create_date );
		}
		
		public function attributeLabels() 
		{
			return array(
				'id' => 'ID',
				'create_date' => 'Дата создания записи',
				'fio' => 'ФИО сотрудника',
				'number' => 'Номер телефона',
				'floor' => 'Этаж',
				'cabinet' => 'Кабинет',
				'status' => 'Видимость',
			);
		}
		
		public function search()
		{
			$criteria=new CDbCriteria;

			$criteria->compare('id',$this->id, true);
			$criteria->compare('number',$this->number, false);
			$criteria->compare('floor',$this->floor, true);
			$criteria->compare('cabinet',$this->cabinet, false);
			$criteria->compare('fio',$this->fio, true);

			$criteria->compare('status',$this->status);
 
			return new CActiveDataProvider('Main', array(
				 'pagination' => array(
					'pageSize' => 10,
				),
				'criteria' => $criteria,
				'sort'=>array(
					'defaultOrder'=>'create_date DESC',
				),
			));
		}
		
		public function beforeValidate() {
			$this->create_date=time();
			return true;
		}
		
	}
	
?>