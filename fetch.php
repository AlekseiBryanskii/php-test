<?php

//fetch.php

echo '
<table class="table table-sm table-dark" border="0">
	<thead >
	  <tr>
		<th>№</th>
		<th>Здание</th>
		<th>Адрес строящегося здания</th>
		<th>Контактные данные застройщика</th>
		<th>Дата сдачи в эксплуатацию</th>
		<th>Данные о здании</th>
		<th>Редактировать</th>
		<th>Удалить</th>
		
	  </tr>
	</thead>
	<tbody>';		
		 
	//$getfile = file_get_contents('test.json');
	$date_buildings = json_decode(file_get_contents('test.json'),true);			
			
	foreach($date_buildings as $index => $building)
		{				
			echo '<tr>' .		
				'<td>' . $index = $index + 1  . '</td>' .
				'<td>' . $building['name_building'] . '</td>' .			
				'<td>' . $building['adress'] . '</td>' .	
				'<td>' . $building['contacts']['tel_zastroishika'] . '<br>' . $building['contacts']['email_zastroishika'] .'</td>' .
				'<td>' . $building['data_sdachi'] . '</td>' .	
				'<td>' . $building['about_buildings'] . '</td>' .
				'<td><button style="width:100%; height:35px" type="button" name="edit" class="btn btn-primary btn-xs edit" id="'.$index.'">Редактировать</button></td>' .
				'<td><button style="width:100%; height:35px" type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$index.'">Удалить</button></td>' .
				'</tr>';
		}										
echo '	
	</tbody>
</table>		
';



?>