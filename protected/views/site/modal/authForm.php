<div id = "auth" class = "over" style = "display:none;">
	<div class = "modal-auth">
		<a href = "javascript:auth_hide();">Закрыть</a>
		<div class = "auto">Авторизация</div>
		<?php
			$form = $this->beginWidget('CActiveForm', array(
				'id' => 'login-form',
				'enableClientValidation' => true,
				'clientOptions' => array(
					'validateOnSubmit' => true,
					'afterValidate' => 'js:function(form, data, hasError) {
						if (!hasError){ 
							str = $("#login-form").serialize() + "&ajax=login-form";
							$.ajax({
								type: "POST",
								url: "' . Yii::app()->createUrl('site/login') . '",
								data: str,
								dataType: "json",
								beforeSend : function() {
									$("#login").attr("disabled",true);
								},
								success: function(data, status) {
									if(data.authenticated)
									{
										$("#auth-data").html(data.link);
										$("#auth").hide();
										$("#contacts").yiiGridView("update");
										$("#add_link").show();
									}
									else
									{
										$("#resultat").html("Неверный логин или пароль!");
										$("#login").attr("disabled",false);
									}
								},
							});
							return false;
						}
					}',
				),
			));
		?>
		<div class = "auto-block">
			<?php echo $form->textField($authForm, 'username', array('class' => 'form-control', 'placeholder' => 'Логин')); ?>
			<?php echo $form->error($authForm, 'username'); ?>
		</div>
		<div class = "auto-block">
			<?php echo $form->passwordField($authForm, 'password', array('class' => 'form-control', 'placeholder' => 'Пароль')); ?>
			<?php echo $form->error($authForm, 'password'); ?>
		</div>          
		<div id = "resultat"></div>
		<div class = "auto-block">
			  <?php echo CHtml::submitButton('Авторизация', array('id' => 'login')); ?>
		</div>
		<?php $this->endWidget(); ?>
    </div>
</div>

<script>
	function auth_hide() {
		$('#auth').hide();
	}
</script>