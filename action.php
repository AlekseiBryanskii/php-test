<?php

//action.php

//include('database_connection.php');

if(isset($_POST["action"])) //проверяем запрос на NULL
{
	if($_POST["action"] == "insert") //проверяем тип запроса (добавление)
	{		
		$date_buildings=json_decode(file_get_contents('test.json'),true); //получаем массив данных о зданиях из файла test.json
		//добавляем новый элемент массива согласно пришедшим данным с формы 		
		$date_buildings[]= 	array(
									'name_building' => $_POST["name_building"],
									'adress' => $_POST["adress"],
									'contacts' => array(
										'tel_zastroishika' => $_POST["tel_zastroishika"],
										'email_zastroishika' => $_POST["email_zastroishika"]			
									),
									'data_sdachi' => $_POST["data_sdachi"],
									'about_buildings' => $_POST["about_buildings"]									 
							     ); 
		$save = file_put_contents('test.json', json_encode($date_buildings, JSON_PRETTY_PRINT)); // сохраняем новый массив в файле test.json
		echo '<p>Данные добавлены</p><br>'; //вывод сообщения о записи данных в окно уведомления action_alert 		
	}
	if($_POST["action"] == "fetch_single") //проверяем тип запроса
	{		
		$date_buildings=json_decode(file_get_contents('test.json'),true);//получаем массив данных о зданиях из файла test.json
		foreach($date_buildings as $key => $value) // обход по коллекции массива date_buildings
		{
			if ($key == $_POST["id"]) //проверка нужного элемента массива для изменения
			{
				$output['name_building'] = $value['name_building'];
				$output['adress'] = $value['adress'];
				$output['tel_zastroishika'] = $value['contacts']['tel_zastroishika'];
				$output['email_zastroishika'] = $value['contacts']['email_zastroishika'];
				$output['data_sdachi'] = $value['data_sdachi'];
				$output['about_buildings'] = $value['about_buildings'];
			}
		}
		echo json_encode($output); //передаем данные о изменяемом элементе массива в форму для редактирования user_form
	}
	if($_POST["action"] == "update") //проверяем тип запроса
	{		
				
		$date_buildings=json_decode(file_get_contents('test.json'),true); //получаем массив данных о зданиях из файла test.json
		foreach($date_buildings as $key => $value) // обход по коллекции массива date_buildings
		{
			if ($key == $_POST["hidden_id"]) //проверка нужного элемента массива для изменения
			{
				$date_buildings[$key]['name_building'] = $_POST["name_building"]; // присваиваем ново значение
				$date_buildings[$key]['adress'] = $_POST["adress"];
				$date_buildings[$key]['contacts']['tel_zastroishika'] = $_POST["tel_zastroishika"];
				$date_buildings[$key]['contacts']['email_zastroishika'] = $_POST["email_zastroishika"];				
				$date_buildings[$key]['data_sdachi'] = $_POST["data_sdachi"];
				$date_buildings[$key]['about_buildings'] = $_POST["about_buildings"];
			}
		}
		$save = file_put_contents('test.json', json_encode($date_buildings, JSON_PRETTY_PRINT)); // сохраняем новый массив в файле test.json			
		
		echo '<p>Данные обновлены</p>'; //вывод сообщения о записи данных в окно уведомления action_alert 
	}
	if($_POST["action"] == "delete") //проверяем тип запроса
	{		
		$date_buildings=json_decode(file_get_contents('test.json'),true); //получаем массив данных о зданиях из файла test.json
		foreach($date_buildings as $key => $value) // обход по коллекции массива date_buildings
		{
			if ($key == $_POST["id"]) //проверка нужного элемента массива для изменения
			{
				array_splice($date_buildings, $key, 1); // удаляем 1 элемент массива по ключу
			}
		}
		$save = file_put_contents('test.json', json_encode($date_buildings, JSON_PRETTY_PRINT)); // сохраняем новый массив в файле test.json	
		echo '<p>Данные удалены</p>';  //вывод сообщения о записи данных в окно уведомления action_alert 
	}
}

?>