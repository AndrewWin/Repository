<!--Файл представления редактирование сотрудника-->
<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'add-form',
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
			'afterValidate' => 'js:function(form, data, hasError) {
				if (!hasError){ 
					str = $("#add-form").serialize() + "&ajax=add-form";
					$.ajax({
						type: "POST",
						url: "' . Yii::app()->createUrl('site/add') . '",
						data: str,
						dataType: "json",
						beforeSend : function() {
							$("#addbutton").attr("disabled", true);
						},
						success: function(data, status) {
							if(data.add)
							{
								$("#result").html("Сотрудник успешно добавлен");
								$("#contacts").yiiGridView("update");
							}
							else
							{
								$("#addbutton").attr("disabled",false);
							}
						},
					});
					return false;
				}
			}',
		),
	));
?>
<div class = "auto">Добавление сотрудника</div>
<div style = "text-align:left; line-height:20px; margin-top:8px;">
	<div>
		<div style = "display:inline-block; float:left; width:50%;">
			<p style = "margin-top:10px;">
				<div>Ф.И.О:</div>
				<?php echo $form->textField($model, 'fio', array('class' => 'form-control', 'placeholder' => 'Ф.И.О')); ?>
				<?php echo $form->error($model, 'fio'); ?>
			</p>
			<p style = "margin-top:10px;">
				<div>Номер телефона:</div>
				<?php echo $form->textField($model, 'number', array('class' => 'form-control', 'placeholder' => 'Номер телефона')); ?>
				<?php echo $form->error($model, 'number'); ?>
			</p>
		</div>
		<div style = "display:inline-block; float:left; width:50%;">
			<p style = "margin-top:10px;">
				<div>Этаж:</div>
				<?php echo $form->textField($model, 'floor', array('class' => 'form-control', 'placeholder' => 'Этаж')); ?>
				<?php echo $form->error($model, 'floor'); ?>
			</p>
			<p style = "margin-top:10px;">
				<div>Кабинет</div>
				<?php echo $form->textField($model, 'cabinet', array('class' => 'form-control', 'placeholder' => 'Кабинет')); ?>
				<?php echo $form->error($model, 'cabinet'); ?>
			</p>
		</div>
	</div>
	<div style = "text-align:center; margin-top:10px;">
		<?php echo CHtml::submitButton('Добавить сотрудника', array('id' => 'addbutton')); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

		  
		

