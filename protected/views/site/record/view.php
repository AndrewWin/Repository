<!--Файл представления карточки сотрудника-->
<?
	$jsonArray = CJSON::decode($model);//Получаем данные в формате JSON
	$mass = explode(" ", $jsonArray['fio']); //Разбиваем поле FIO на массив (чтобы было отдельно)
?>
<div class = "auto">Просмотр сотрудника</div>
<div style = "text-align:left; line-height:20px; margin-top:8px;">
	<div style = "width:50%; display:inline-block; float:left;">
		<p>Дата создания:</p>
		<p>Фамилия:</p>
		<p>Имя:</p>
		<p>Отчество:</p>
		<p>Номер телефона:</p>
		<p>Этаж:</p>
		<p>Кабинет:</p>
	</div>
	<div style = "width:50%; display:inline-block; float:left;">
		<p><? echo $jsonArray['create_date']; ?></p>
		<? foreach($mass  as $key => $value): ?> 
			<p><? echo $value; ?></p>
		<? endforeach; ?>
		<p><? echo $jsonArray['number']; ?></p>
		<p><? echo $jsonArray['floor']; ?> этаж</p>
		<p><? echo $jsonArray['cabinet'];?> кабинет</p>
	</div>
</div>