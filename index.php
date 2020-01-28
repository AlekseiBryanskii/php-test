<html>  
    <head>  
        <title>Crud приложение для редактирования файла JSON</title>  
		<link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/bootstrap.min.css" />
		<script src="js/jquery.min.js"></script>  
		<script src="js/jquery-ui.js"></script>
				
    </head>  
    <body>  
        <div class="container">
			<br />
			
			<h3 align="center">Crud приложение для редактирования файла JSON</a></h3><br />
			<br />
			<div align="right" style="margin-bottom:5px;">
			<!-- -->
			<!-- Создаем кнопку Добавить запись использую стиль bootstrap -->
			<button style="width:100%; height:35px" type="button" name="add" id="add" class="btn btn-success btn-xs">Добавить запись</button>
			</div>
			<!-- Контейнер для хранения таблицы о зданиях -->
			<div class="table-responsive"  id="user_data">
				
			</div>
			<br />
		</div>
		<!-- Форма для добавления и редактирования записей -->
		<div id="user_dialog" title="Введите данные">
			<form method="post" id="user_form">
				<div class="form-group">
					<label>Здание</label>
					<input type="text" name="name_building" id="name_building" class="form-control" />
					<span id="error_name_building" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Адрес строящегося здания</label>
					<input type="text" name="adress" id="adress" class="form-control" />
					<span id="error_adress" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Номер телефона</label>
					<input type="text" name="tel_zastroishika" id="tel_zastroishika" class="form-control" />
					<span id="error_tel_zastroishika" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email_zastroishika" id="email_zastroishika" class="form-control" />
					<span id="error_email_zastroishika" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Дата сдачи в эксплуатацию</label>
					<input type="text" name="data_sdachi" id="data_sdachi" class="form-control" />
					<span id="error_data_sdachi" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Данные о здании</label>
					<input type="text" name="about_buildings" id="about_buildings" class="form-control" />
					<span id="error_about_buildings" class="text-danger"></span>
				</div>
				<div class="form-group">
					<input type="hidden" name="action" id="action" value="insert" />
					<input type="hidden" name="hidden_id" id="hidden_id" />
					<input type="submit" name="form_action" id="form_action" class="btn btn-info" value="Insert" />
				</div>
			</form>
		</div>		
		
		<!-- Контейнер для вывода информирующего окна -->
		<div id="action_alert" title="Информация">
			
		</div>
		<!-- Контейнер для вывода окна с подтверждением на удаление записи -->
		<div id="delete_confirmation" title="Подтвердите действие">
		<p>Удалить запись?</p>
		</div>
		
    </body>  
</html>  




<script>  
$(document).ready(function(){  

	load_data();  // вызов функции заполнения данных
	
	
	function load_data()
	{
		$.ajax({
			url:"fetch.php",
			method:"POST",
			success:function(data)
			{
				$('#user_data').html(data);
			}
		});
	} // функция загрузки данных с json файла
		
	
	$("#user_dialog").dialog({
		autoOpen:false,
		width:500
	}); // настраиваем размер окна для ввода данных и отключаем свойство автоматического открытия при загрузке страницы
	
	$('#add').click(function(){ //событие нажатия на кнопку Добавить запись
		$('#user_dialog').attr('title', 'Введите данные'); // передаем значение tittle элементу div для отображения текущего действия
		$('#action').val('insert'); // передаем название операции  
		$('#form_action').val('Добавить запись'); // изменяем значение кнопки в соотвествии с действием
		$('#user_form')[0].reset(); // очищаем значения элементов
		$('#form_action').attr('disabled', false); // делаем кнопку не активной (для того чтобы юзер не записал дважды )
		$("#user_dialog").dialog('open'); //открываем форму
	});
	
	$('#user_form').on('submit', function(event){
		event.preventDefault();
		var error_name_building = ''; // обьявляем значения переменных об ошибках на форме
		var error_adress = '';
		var error_tel_zastroishika = '';
		var error_email_zastroishika = '';
		var error_data_sdachi = '';
		var error_about_buildings = '';
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/; //реглярное выражение для прорки корректности email
		
		
		if($('#name_building').val() == '') //проверка на заполненость поля Здание
		{
			error_name_building = 'Введите название здания'; 
			$('#error_name_building').text(error_name_building); //выводим сообщение в элемент span об ошибке
			$('#name_building').css('border-color', '#cc0000'); // делаем границу поля красным для указания поля в котором совершена ошибка
		}
		else
		{
			error_name_building = ''; 
			$('#error_name_building').text(error_name_building); // удаляем значение в span
			$('#name_building').css('border-color', ''); // возвращаем в исходное состояние 
		}
		if($('#adress').val() == '')
		{
			error_adress = 'Введите адрес';
			$('#error_adress').text(error_adress);
			$('#adress').css('border-color', '#cc0000');
		}
		else
		{
			error_adress = '';
			$('#error_adress').text(error_adress);
			$('#adress').css('border-color', '');
		}
		if($('#tel_zastroishika').val() == '')
		{
			error_tel_zastroishika = 'Введите телефон';
			$('#error_tel_zastroishika').text(error_tel_zastroishika);
			$('#tel_zastroishika').css('border-color', '#cc0000');
		}
		else
		{
			error_tel_zastroishika = '';
			$('#error_tel_zastroishika').text(error_tel_zastroishika);
			$('#tel_zastroishika').css('border-color', '');
		}
		
		if($('#email_zastroishika').val() == '' || !regex.test($('#email_zastroishika').val())  )
		{
			error_email_zastroishika = 'Не корректный emal';
			$('#error_email_zastroishika').text(error_email_zastroishika);
			$('#email_zastroishika').css('border-color', '#cc0000');
		}
		else
		{
			error_email_zastroishika = '';
			$('#error_email_zastroishika').text(error_email_zastroishika);
			$('#email_zastroishika').css('border-color', '');
		}
		
		if($('#data_sdachi').val() == '')
		{
			error_data_sdachi = 'Введите дату сдачи в эксплуатацию';
			$('#error_data_sdachi').text(error_data_sdachi);
			$('#data_sdachi').css('border-color', '#cc0000');
		}
		else
		{
			error_data_sdachi = '';
			$('#error_data_sdachi').text(error_data_sdachi);
			$('#data_sdachi').css('border-color', '');
		}
		if($('#about_buildings').val() == '')
		{
			error_about_buildings = 'Введите данные о здании';
			$('#error_about_buildings').text(error_about_buildings);
			$('#about_buildings').css('border-color', '#cc0000');
		}
		else
		{
			error_about_buildings = '';
			$('#error_about_buildings').text(error_about_buildings);
			$('#about_buildings').css('border-color', '');
		}
		
		if(error_name_building != '' || error_adress != '' || error_tel_zastroishika != '' || error_data_sdachi != '' || error_about_buildings != '' || error_email_zastroishika != '') // если какой-то из элементов с ошибками то ничего не делаем
		{
			return false;
		}
		else
		{  // если поьзователь заполнил правильно то 
			$('#form_action').attr('disabled', 'disabled'); // блокируем кнопку
			var form_data = $(this).serialize(); // собираем данные с формы
			$.ajax({
				url:"action.php", // направляем данные запроса на исполнение
				method:"POST", // метод запроса 
				data:form_data, // тут данные с формы
				success:function(data) // функция выполняется в случае успешной передачи
				{
					$('#user_dialog').dialog('close'); // закрываем форму
					$('#action_alert').html(data); // выводим статус действия в информирующее окно
					$('#action_alert').dialog('open'); // открываем информирующее окно
					load_data(); // вызов функции для оьновления данных на странице
					$('#form_action').attr('disabled', false); // делаем кнопку на форму активной
				}
			});
		}
		
	});
	
	$('#action_alert').dialog({
		autoOpen:false
	}); // информирующее окно
		
	$(document).on('click', '.edit', function(){		// событие нажатия на кнопку редактировать
		var id = $(this).attr('id'); // узнаем id button - он соответствует индексу элемента в массиве
		var action = 'fetch_single';	// тип действия	
		
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",  // запрашиваем данные из массива с id согласно кнопке
			success:function(data)
			{
				$('#name_building').val(data.name_building);
				$('#adress').val(data.adress);
				$('#tel_zastroishika').val(data.tel_zastroishika);
				$('#email_zastroishika').val(data.email_zastroishika);			
				$('#data_sdachi').val(data.data_sdachi);
				$('#about_buildings').val(data.about_buildings);   // присваиваем полученные значения элементам формы
								
				$('#user_dialog').attr('title', 'Введите данные'); 
				$('#action').val('update'); // выбор типа операции
				$('#hidden_id').val(id); 
				$('#form_action').val('Обновить запись'); // изменяем название кнопки
				$('#user_dialog').dialog('open'); // открываем форму редактирования, принцип работы как с добавлением записи но работает метод update на action.php
				
			}
		});
	});
	
	$('#delete_confirmation').dialog({ // вызов всплывающего окна с 2 кнопками
		autoOpen:false,
		modal: true,
		buttons:{
			Ok : function(){ 
				var id = $(this).data('id'); // получаем значение id от кнопки
				var action = 'delete';
				$.ajax({
					url:"action.php",
					method:"POST",
					data:{id:id, action:action}, // устанавливаем id и операцию над записью
					success:function(data)
					{
						$('#delete_confirmation').dialog('close'); // закрываем информирующую форму
						$('#action_alert').html(data); // вывод сообщения
						$('#action_alert').dialog('open'); // показываем окно с информацией
						load_data(); // отображаем отредактированную таблицу
					}
				});
			},
			Cancel : function(){ // закрываем всплывающее окно если нажали cansel
				$(this).dialog('close');
			}
		}	
	});
	
	$(document).on('click', '.delete', function(){ // событие нажатия кнопки
		var id = $(this).attr("id");  // получаем значение id от кнопки
		$('#delete_confirmation').data('id', id).dialog('open'); //передаем id нажатой кнопки и открываем диалоговое окно
	});
	
});    
</script>