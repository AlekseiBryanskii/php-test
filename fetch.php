<?php

//fetch.php

echo '
<table class="table table-sm table-dark" border="1">
	
	<thead >
	  <tr>
		<th>№</th>
		<th>Здание</th>
		<th>Адрес строящегося здания</th>
		<th>Контактные данные застройщика</th>
		<th>Дата сдачи в эксплуатацию</th>		
		<th>Редактировать</th>
		<th>Удалить</th>
		
		
	  </tr>
	</thead>
	<tbody>';		// подгатавливаем заголовки таблицы
		 //<th>Данные о здании</th>
	
	$date_buildings = json_decode(file_get_contents('test.json'),true);	// получаем массив данных из файла 	test.json	
	if ( !empty($date_buildings))
	{
		foreach($date_buildings as $index => $building)
		{				
			// помещаем таблицу в контейнер div c ID = user_data и создаем кнопки для редактирования и удаления с присвоением свойства id для кнопок
			echo '<tr>' .		
					'<td rowspan="2">' . $index = $index + 1  . '</td>' .
					'<td colspan="1">' . $building['name_building'] . '</td>' .			
					'<td colspan="1">' . $building['adress'] . '</td>' .	
					'<td colspan="1">' . $building['contacts']['tel_zastroishika'] . '<br>' . $building['contacts']['email_zastroishika'] .'</td>' .
					'<td colspan="1">' . $building['data_sdachi'] . '</td>' .				
					'<td colspan="1"><button style="width:100%; height:35px" type="button" name="edit" class="btn btn-primary btn-xs edit" id="'.$index.'">Редактировать</button></td>' .
					'<td colspan="1"><button style="width:100%; height:35px" type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$index.'">Удалить</button></td>' .
				'</tr>'.
				'<tr>' .
					'<td colspan="6">' . $building['about_buildings'] . '</td>' .
				'</tr>';				
		}		
	}		
									
echo '	
	</tbody>
</table>		
';
//закрываем теги table


?>