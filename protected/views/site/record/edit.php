<!--Файл представления редактирование сотрудника-->
<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'edit-form',
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
			'afterValidate' => 'js:function(form, data, hasError) {
				if (!hasError){ 
					str = $("#edit-form").serialize() + "&ajax=edit-form";
					$.ajax({
						type: "POST",
						url: "' . Yii::app()->createUrl('site/edit/id/'.$model->id) . '",
						data: str,
						dataType: "json",
						beforeSend : function() {
							$("#editbutton").attr("disabled", true);
						},
						success: function(data, status) {
							if(data.edit)
							{
								$("#res").html("Сотрудник успешно изменен");
								$("#editbutton").attr("disabled",false);
								j("#contacts").yiiGridView("update");
							}
							else
							{
								$("#editbutton").attr("disabled",false);
							}
						},
					});
					return false;
				}
			}',
		),
	));
?>
<div class = "auto">Редактирование сотрудника</div>
<div style = "text-align:left; line-height:20px; margin-top:8px;">
	<div style = "display:inline-block; float:left; width:50%;">
		<p style = "margin-top:10px;">
			<div>Ф.И.О</div>
			<?php echo $form->textField($model, 'fio', array('class' => 'form-control', 'placeholder' => 'Ф.И.О')); ?>
			<?php echo $form->error($model, 'fio'); ?>
		</p>
		<p style = "margin-top:10px;">
			<div>Кабинет</div>
			<?php echo $form->textField($model, 'cabinet', array('class' => 'form-control', 'placeholder' => 'Кабинет')); ?>
			<?php echo $form->error($model, 'cabinet'); ?>
		</p>
	</div>
	<div style = "display:inline-block; float:left; width:50%;">
		<p style = "margin-top:10px;">
			<div>Номер телефона:</div>
			<?php echo $form->textField($model, 'number', array('class' => 'form-control', 'placeholder' => 'Номер телефона')); ?>
			<?php echo $form->error($model, 'number'); ?>
		</p>
		<p style = "margin-top:10px;">
			<div>Этаж:</div>
			<?php echo $form->textField($model, 'floor', array('class' => 'form-control', 'placeholder' => 'Этаж')); ?>
			<?php echo $form->error($model, 'floor'); ?>
		</p>
	</div>
	<div style = "display:inline-block; width:100%;">
		
	</div>
	<div style = "text-align:center; "id = "res"></div>
	<div style = "text-align:center; margin-top:10px;">
		<?php echo CHtml::submitButton('Сохранить изменения', array('id' => 'editbutton')); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

		  
		

