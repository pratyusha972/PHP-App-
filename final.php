<style>
table,th,td{
border :1px solid black;
	text-align :center;
padding : 5px;
	  font-size:large;
	  border-collapse :collapse;}
td:hover {background-color:grey!important; cursor:pointer;}
</style>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="GET">
Name: <input type="text" name="game">   
Country: <input type="text" name="gountry">
<input type="submit" name="submit" value="Filter">
</form>

<?php
if(empty($_GET['game']) && empty($_GET['gountry']))
{
	$value=0;
	$str = file_get_contents('weather.json');
	$json = json_decode($str, true);
	//echo print_r($json,true);
	$shit = $json['list'];
	?>
		<table width="30%">
		<tr bgcolor="#a9a9a9">
		<th > ID </th>
		<th > Name </th>
		<th > Country </th>
		</tr>
		<?php
		foreach ($shit as $r)
		{
			if ($value%2==0){
				$val ="#D3D3D3";}
			else{
				$val = "#ffffff";}
			?>
				<tr bgcolor="<?php echo $val; ?>" >
				<td onclick="document.write('<?php kill($r['id']) ?>');"> <?php echo $r['id']; ?>  </td>
				<td ><?php echo $r['name']; ?></td>
				<td ><?php echo $r['sys']['country']; ?></td>
				<tr>
				<?php
				$value=$value+1;
		}
}?>
</table>

<?php
if(isset($_GET['game']) && isset($_GET['gountry']) && (($_GET['game']!="" && $_GET['gountry']=="") || ($_GET['game']=="" && $_GET['gountry']!="") || ($_GET['game']!="" && $_GET['gountry']!="")))
{
	echo "<br>";
	?>
		<table width="30%">
		<tr bgcolor=#a9a9a9>
		<th > ID </th>
		<th > Name </th>
		<th > Country </th>
		</tr>
		<?php
		$value=0;

	$city=$_GET['game'];
	$country=$_GET['gountry'];
	$str = file_get_contents('weather.json');
	$json = json_decode($str, true);
	$shit = $json['list'];
	foreach ($shit as $r)
	{
		if (($city == $r['name'] && $country == $r['sys']['country']) || ($city == $r['name'] && $country =="") || ($city == "" && $country == $r['sys']['country']))
		{
			if ($value%2==0){
				$val ="#D3D3D3";}
			else{
				$val = "#ffffff";}
			?>
				<tr bgcolor="<?php echo $val; ?>" >
				<td onclick="document.write('<?php kill($r['id']) ?>');"><?php echo $r['id']; ?></td>
				<td ><?php echo $r['name']; ?></td>
				<td ><?php echo $r['sys']['country']; ?></td>
				<tr>
				<?php
				$value=$value+1;
		}
	}
	?>
		</table>
		<?php } ?>
<?php
function kill($e)
{
	$str = file_get_contents('weather.json');
	$json = json_decode($str, true);
	$shit = $json['list'];
	foreach ($shit as $r)
	{
		if ($e == $r['id'])
		{
			echo "<br>";
			echo $r['id'],"<br>";  
			echo $r['name'],"<br>";
			echo $r['sys']['country'],"<br>";
			echo "longitudinal"," ",$r['coord']['lon'],"<br>";
			echo "latitude"," ",$r['coord']['lat'],"<br>";
			echo "type"," ",$r['sys']['type'],"<br>";
			echo "sysid"," ",$r['sys']['id'],"<br>";
			echo "message"," ",$r['sys']['message'],"<br>";
			echo "sunrise"," ",$r['sys']['sunrise'],"<br>";
			echo "sunset"," ",$r['sys']['sunset'],"<br>";
			$yay = $r['weather'];
			foreach ($yay as $t)
			{
				echo "weatherid"," ",$t['id'],"<br>";
				echo "main"," ",$t['main'],"<br>";
				echo "description"," ",$t['description'],"<br>";
				echo "icon"," ",$t['icon'],"<br>";
			}
			echo "maintemp"," ",$r['main']['temp'],"<br>";
			echo "humidity"," ",$r['main']['humidity'],"<br>";
			echo "pressure"," ",$r['main']['pressure'],"<br>";
			echo "min_temp"," ",$r['main']['temp_min'],"<br>";
			echo "max_temp"," ",$r['main']['temp_max'],"<br>";
			echo "wind_speed"," ",$r['wind']['speed'],"<br>";
			echo "wind_deg"," ",$r['wind']['deg'],"<br>";
			echo "cloudsall"," ",$r['clouds']['all'],"<br>";
			echo "dt"," ",$r['dt'],"<br>";
		}
	}
}
flush();
?>
