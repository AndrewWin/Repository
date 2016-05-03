<?php
	class LoginForm extends CFormModel
	{
		public $username;
		public $password;
		
		private $_identity;
 
		public function rules()
		{
			return array(
				array('username, password', 'required'),
				array('password', 'authenticate'),
			);
		}
	 
		public function authenticate($attribute,$params)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate()) {
				$this->addError('password','Неправильное имя пользователя или пароль!!!!');
			} 
		}
		
		public function attributeLabels() 
		{
			return array(
				'username' => 'Имя пользователя',
				'password' => 'Пароль',
			);
		}

	}