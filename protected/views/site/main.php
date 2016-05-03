<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>	
		<meta charset = "utf=8">
		<title><? echo 'Начало создания: '.Yii::app()->params['start_date'].' | Версия приложения: '.Yii::app()->params['version'].' | Версия Yii: '.Yii::getVersion(); ?></title>
		<? Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/style.css'); ?>
		<? Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/roboto.css'); ?>	
		<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	</head>
	<body>
		<?php $this->widget('application.components.widgets.WAuthModal'); ?>
		<?php $this->widget('application.components.widgets.WViewModal'); ?>
		
		<div id = "wrap">
			<div id = "wrap-inner">
				<h1>Телефонный справочник</h1>
				<div class = "content">
					<div id = "top-navigation">
						<div id = "auth-data" style = "display: inline-block; float: right;">
							<? $this->renderPartial("_auth", null, false, false); ?>
						</div>
						<!--<div class = "search"> // Поиск, пока не нужен
							<input type = "text" placeholder = "Поиск.." />
						</div>-->
					</div>
					<div id = "data">
						<?php
							function ViewAdmin($check) {
								if ($check == true) {
									return false;
								} else {
									return true;
								}
							}
							$this->widget('zii.widgets.grid.CGridView', array(
								'dataProvider' => $model->search(),
								'id' => 'contacts', //Ид виджета
								'htmlOptions' => array('class' => 'table'), //Класс обертки
								//'filter' => $model,
								'template' => "{items}\n{pager}",
								'summaryText' => 'бла бла',
								'ajaxUpdate'=>'contacts',
								'columns' => array(
									array(
									'header'=>'№',
										'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)', //Выводим порядковый номер записи
									),
									array (
										'name' => 'create_date',
										'value' => 'Yii::app()->dateFormatter->format("dd.M.yyyy", $data->create_date)', //Дата создания записи
									),
									'fio', 		//Фамилия
									'number',   //Номер телефона
									'floor',    //Этаж
									'cabinet',  //Кабинет
									array(
										'class' => 'CButtonColumn',
										'template' => '<nobr>{view}{edit}{delete}</nobr>',
										'visible' => 'false',
										'buttons' => array(
											'view' => array(
												'label' => 'Просмотр сотрудника',
												'imageUrl' => '/images/add.png',
												'url' => '"javascript:ajax_send(\'view\', \'".$data->id."\');"',
											),
											'edit' => array(
												'label' => 'Редактировать',
												'imageUrl' => '/images/edit.png',
												'url' => '"javascript:ajax_send(\'edit\', \'".$data->id."\');"',
												'visible'=>'ViewAdmin(Yii::app()->user->isGuest)',
											),
											'delete' => array(
												'label' => 'Удалить',
												'imageUrl' => '/images/delete.png',
												'deleteConfirmation' => 'Вы уверены что хотите удалить сотрудника?',
												'url' => 'Yii::app()->createUrl("site/delete", array("id"=>$data->id))',
												'visible'=>'ViewAdmin(Yii::app()->user->isGuest)',
											),
										),            
									),
								),
								'pager'=> array(  
									'header' => '<span style = "vertical-align: middle; margin-right:6px;">Перейти на страницу:</span>',
									'prevPageLabel' => '&laquo; назад',
									'nextPageLabel' => 'вперед &raquo;',    
									'selectedPageCssClass' => 'active',
									'hiddenPageCssClass' => 'disabled',
								), 
							));					
						?>
						<a id = "add_link" style = "display:<? if (!Yii::app()->user->isGuest) { ?>block;<? } else { ?>none;<? } ?>" href = "javascript:ajax_send('add', 'null');">Добавить запись</a>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script>
		//Построение AJAX запросов (действие над записями)
		function ajax_send(action, id) {
			var url1 =  "/site/record/action/"+ action +"/id/0";
			var url2 =  "/site/record/action/"+ action +"/id/"+ id;
		
			$.ajax({
				url: (id == "null") ? url1 : url2,
				status: $("#results").html('Загрузка...'),
				success: function(data) {
					$("#result").html(data);
					$('#view').show();
				},
				error:  function(xhr, str){
					$("#result").html('Сервер вернул ошибку, попробуйте позже');
					$('#view').show();
				}
			});
		}
 	</script>
</html>