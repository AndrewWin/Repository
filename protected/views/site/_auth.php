<ul>
	<? if(Yii::app()->user->isGuest) { ?>
		<li><a href = "javascript:authShow();">Авторизация</a></li>
	<? } else { ?>
		<li>Добро пожаловать <? echo  Yii::app()->user->name; ?>, <a href = "/site/logout">выйти</a></li>
	<? } ?>
</ul>
<script>
	function authShow() {
		$('#auth').show();
	}
</script>
	