<?php

//action.php

//include('database_connection.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{
		/*
		$query = "
		INSERT INTO tbl_sample (first_name, last_name) VALUES ('".$_POST["first_name"]."', '".$_POST["last_name"]."')
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Inserted...</p>';
		*/
		//	$date_buildings[]= ['name_building' => 'Новый', 'adress' => '123', 'contacts' => ['tel_zastroishika'=>'95-32-47', 'email_zastroishika'=>'123@gmail.com'], 'data_sdachi' => '12/02/2015', 'about_buildings'=>'Инфа о здании' ];
		$date_buildings=json_decode(file_get_contents('test.json'),true);
				
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
		$save = file_put_contents('test.json', json_encode($date_buildings, JSON_PRETTY_PRINT));
		echo '<p>Данные добавлены</p><br>';
		//echo '<p>Форма закроется автоматически через 2 секунды</p>';
	}
	if($_POST["action"] == "fetch_single")
	{
		/*
		$query = "
		SELECT * FROM tbl_sample WHERE id = '".$_POST["id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['first_name'] = $row['first_name'];
			$output['last_name'] = $row['last_name'];
		}
		echo json_encode($output);
		*/
		$date_buildings=json_decode(file_get_contents('test.json'),true);
		foreach($date_buildings as $key => $value)
		{
			if ($key == $_POST["id"])
			{
				$output['name_building'] = $value['name_building'];
				$output['adress'] = $value['adress'];
				$output['tel_zastroishika'] = $value['contacts']['tel_zastroishika'];
				$output['email_zastroishika'] = $value['contacts']['email_zastroishika'];
				$output['data_sdachi'] = $value['data_sdachi'];
				$output['about_buildings'] = $value['about_buildings'];
			}
		}
		echo json_encode($output);
	}
	if($_POST["action"] == "update")
	{
		/*
		$query = "
		UPDATE tbl_sample 
		SET first_name = '".$_POST["first_name"]."', 
		last_name = '".$_POST["last_name"]."' 
		WHERE id = '".$_POST["hidden_id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		*/
		
		
		$date_buildings=json_decode(file_get_contents('test.json'),true);
		foreach($date_buildings as $key => $value)
		{
			if ($key == $_POST["hidden_id"])
			{
				$date_buildings[$key]['name_building'] = $_POST["name_building"];
				$date_buildings[$key]['adress'] = $_POST["adress"];
				$date_buildings[$key]['contacts']['tel_zastroishika'] = $_POST["tel_zastroishika"];
				$date_buildings[$key]['contacts']['email_zastroishika'] = $_POST["email_zastroishika"];				
				$date_buildings[$key]['data_sdachi'] = $_POST["data_sdachi"];
				$date_buildings[$key]['about_buildings'] = $_POST["about_buildings"];
			}
		}
		$save = file_put_contents('test.json', json_encode($date_buildings, JSON_PRETTY_PRINT));			
		
		echo '<p>Данные обновлены</p>';
	}
	if($_POST["action"] == "delete")
	{
		/*
		$query = "DELETE FROM tbl_sample WHERE id = '".$_POST["id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		*/
		$date_buildings=json_decode(file_get_contents('test.json'),true);
		foreach($date_buildings as $key => $value)
		{
			if ($key == $_POST["id"])
			{
				array_splice($date_buildings, $key, 1);
			}
		}
		$save = file_put_contents('test.json', json_encode($date_buildings, JSON_PRETTY_PRINT));
		echo '<p>Данные удалены</p>';
	}
}

?>