<?
	return array (
		'name'=>'Мой первый сайт на Yii Framework!',
		'defaultController' => 'site', 
		'language' => 'ru',

		'modules'=>array(
			'gii'=>array( 
				'class'=>'system.gii.GiiModule',
				'password'=>'YourPassword',
				'ipFilters'=>array(),
			),
		),
		
		
		'import'=>array(
			'application.models.*',
			'application.components.*',
		),
		 
		'components'=>array(
			'urlManager'=>array( 
				'urlFormat'=>'path',
				'rules'=>array(
					'<controller:w+>/<id:d+>'=>'<controller>/view',
					'<controller:w+>/<action:w+>/<id:d+>'=>'<controller>/<action>',
					'<controller:w+>/<action:w+>'=>'<controller>/<action>',
				),
			),
			'db'=>array(
				'connectionString' => 'sqlite:protected/data/base.db',
				'tablePrefix' => 'tbl_',
			),
			'user'=>array(
				'allowAutoLogin'=>true,
			),
		),

		'params'=>array( 
			'version'=>'0.1',
			'start_date'=>'28.04.2016',
		),
	);