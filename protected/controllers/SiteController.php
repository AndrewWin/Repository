<?php

	class SiteController extends CController
	{
		public $breadcrumbs=array();
		public function actions()
		{
			return array(
				'captcha'=>array(
					'class'=>'CCaptchaAction',
					'backColor'=>0xFFFFFF,
				),
				'page'=>array(
					'class'=>'CViewAction',
				),
			);
		}
		public function actionIndex()
		{
			$model = new Main;
			$this->render('main', array('model' => $model));
		}
		
		
		public function actionLogin()
		{
			$model = new LoginForm; //Подключаем модель
			if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') //Проверяем не пустые ли данные и соответствует ли форма
			{
				$errors = CActiveForm::validate($model);
				if ($errors != '[]')
				{
					echo $errors;
					Yii::app()->end();
				}
			}
			if (isset($_POST['LoginForm'])) //Проверяем не пустые ли данные
			{
				if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
				{
					echo CJSON::encode(array(
						'authenticated' => true,
						'link' => '<li style = "list-style-type: none;">Добро пожаловать '.Yii::app()->user->name.' <a href = "/site/logout">выйти</a></li>',
					));
					Yii::app()->end();
				}
			}
		}
			
		public function actionLogout() //Выход из аккаунта
		{
			Yii::app()->user->logout();
			$this->redirect(Yii::app()->homeUrl);
		}
		
	
		/*---------Манипуляция с записями-----------*/
		public function actionEdit($id)
		{
			
			$model = Main::model()->findByPk($id);
			if (isset($_POST['ajax']) && $_POST['ajax'] === 'edit-form')
			{
				$errors = CActiveForm::validate($model);
				if ($errors != '[]')
				{
					echo $errors;
					Yii::app()->end();
				}
			}
			if (isset($_POST['Main']))
			{
				if (isset($_POST['ajax']) && $_POST['ajax'] === 'edit-form')
				{
					$model->attributes=$_POST['Main'];
					if ($model->save()) {
						echo CJSON::encode(array(
							'edit' => true,
						));
					}
					Yii::app()->end();
				}
			}
		}
		
		public function actionAdd() //Добавление сотрудника
		{
			$model = new Main; //Подключаем модель данных
			if (isset($_POST['ajax']) && $_POST['ajax'] === 'add-form') //Ajax и соответствие
			{
				$errors = CActiveForm::validate($model);
				if ($errors != '[]')
				{
					echo $errors;
					Yii::app()->end();
				}
			}
			if (isset($_POST['Main']))
			{
				if (isset($_POST['ajax']) && $_POST['ajax'] === 'add-form')  //Ajax и соответствие
				{
					$model->attributes=$_POST['Main'];
					if ($model->save()) {
						echo CJSON::encode(array(
							'add' => true, // Если сотрудник добавлен, возвращаем json с ключом add значение true
						));
					}
					Yii::app()->end();
				}
			}
		}
		
		public function actionDelete($id) //Удаление записей
		{
			if (Yii::app()->request->isAjaxRequest and !Yii::app()->user->isGuest) { //Проверяем AJAX запрос ли это, и авторизирован ли пользователь
				$model=Main::model()->findByPk($id); //Ищем сотрудника id = полученному $id
				$model->delete(); //Удаляем
			} else { //Не даем использовать без AJAX, или если пользователь не авторизирован
				$this->redirect(Yii::app()->user->returnUrl); //Отправляем на главную страницу
			}
		}
		
		public function actionUpdateAjax()
		{
			$this->renderPartial('_auth', null, false, true);
		}
		
		/*---------Манипуляция с записями-----------*/
		public function actionRecord($action, $id) //Функция вывода модальных окон
		{
			if ($action == "view") { //Действие просмотр сотрудника
				$jsonArray = array();
				$model = Main::model()->find('id='.$id);
				if ($model->id) {
					foreach ($model as $key => $value) {
						$jsonArray[$key] = $value;
					}
					$this->render('record/view', array('model'=> CJSON::encode($jsonArray))); //Формируем представление с данными в формате JSON
				} else {
					echo 'Ошибка, сотрудник не найден.';
				}
			}
			if (!Yii::app()->user->isGuest) { //Проверяем, авторизирован ли пользователь
				if ($action == "edit") { //Редактирование сотрудника
					$model = Main::model()->find('id='.$id);
					if ($model->id) {
						$this->render('record/edit', array('model' => $model));
					} else {
						echo 'Ошибка, сотрудник не найден.';
					}
				} else if ($action == "add") { //Добавление сотрудника
					$model = new Main;
					$this->render('record/add', array('model' => $model));
				} else if ($action == "delete") { //Добавление сотрудника
					$model=Main::model()->findByPk($id); 
					$model->delete();
				}
			}
		}
		
	}