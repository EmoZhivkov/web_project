<?php

require_once('config.php');
require_once('template.php');

$tpl->get_tpl('up.htm');
$title = '';
$description = '';
$query = 'SELECT * FROM dumi WHERE id=1';
$stmt = $db->query($query);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$title = $row['t'];
	$description = $row['d'];
}	
$tpl->set_value('title',$title);          
$tpl->set_value('description',$description);  
$tpl->set_value('meta','');            

$tpl->tpl_parse();
echo $tpl->html;

require_once('menu.php');

$allcolors = array('#c0343d', '#751e24', 'black', '#283537', '#ed3c45', '#cccccc', '#c0343d', '#751e24', 'black', '#283537', '#ed3c45', '#cccccc', '#c0343d', '#751e24', 'black', '#283537', '#ed3c45', '#cccccc');

$vis1 = GetVis($db, 1);
$vis2 = GetVis($db, 2);
$vis3 = GetVis($db, 3);

?>
<div class="contoverall">   
     <div class="slide">
		<img src="images/slider.jpg" class="objectfit" alt="WebMusic">
     </div>
</div>

<?php
if ($vis1=='Да') {
$allproducts = 0;
$counter = 0;
$highest = 0;
$query = "SELECT * FROM products ORDER by played desc LIMIT 8";
$stmt = $db->query($query);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$counter += 1;
	if ($counter==1) {
		$highest = $row['played'] * 70;
	}
    $allproducts += $row['played'];
}

$elements = '';
$bottoms = '';
$colorid = -1;
$query = "SELECT * FROM products ORDER by played desc LIMIT 8";
$stmt = $db->query($query);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$colorid += 1;
	$procent = ($row['played'] * 100) / $allproducts;
	$procent += 10;
	$procent = number_format($procent, 1, '.', ' ');
	$elements .= '<td width="12%" height="' .$highest .'" valign="bottom"><div style="display:block;height:' .$procent .'%;background:' .$allcolors[$colorid] .';color:white;width:100%;text-align:top;padding:7px;padding-top:10px;">' .$row['played'] .'</div></td>';
	$bottoms .= '<td width="12%" align="center">' .$row['ime'] .'</td>';
}
?>
<div class="contoverall">
	<div class="contall">
        <div class="call centered paddingupdown centered">
			<h1 class="centered">НАЙ-СЛУШАНИ ПЕСНИ</h1>
			<table width="800" cellspacing="5">
				<tr><?=$elements?></tr>
				<tr><?=$bottoms?></tr>
			</table>
		</div>
	</div>
</div>
<?php
}
?>



<?php
if ($vis2=='Да') {
$allproducts = 0;
$query = "SELECT COUNT(*) as productscount FROM products";
$stmt = $db->query($query);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $allproducts += $row['productscount'];
}

$elements = '';
$colors = '';
$colorid = -1;
$query = "SELECT vidove.*, (SELECT COALESCE(COUNT(products.id),0) FROM products WHERE products.vid=vidove.id) as productscount FROM vidove ORDER by id";
$stmt = $db->query($query);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	if ($row['productscount']>0) {
		$colorid += 1;
		$procent = ($row['productscount'] * 100) / $allproducts;
		$procent = number_format($procent / 100, 1, '.', ' ');
		$elements .= $row['ime'] .':' .$procent .',';
		$colors .= $row['ime'] .':\'' .$allcolors[$colorid] .'\',';
	}
}
$elements = substr($elements, 0, strlen($elements) - 1);
$colors = substr($colors, 0, strlen($colors) - 1);
?>
<div class="contoverall">
	<div class="contall">
        <div class="call centered paddingupdown centered">
			<h1 class="centered">БРОЙ ВИДЕА ПО ЖАНРОВЕ</h1>
			<canvas width="800" height="800" id="example">
			</canvas>
			<script type="text/javascript">
				var elements = {<?=$elements?>};
				var colors = {<?=$colors?>};

				var canvas = document.getElementById('example');
				var chart = chartJS.PieChart(elements, colors, canvas);
				chart.draw();
			</script>
		</div>
	</div>
</div>
<?php
}
?>

<?php
if ($vis3=='Да') {
$elements = '';
$colorid = -1;
$query = "SELECT clients.*, (SELECT COALESCE(COUNT(products.id),0) FROM products WHERE products.clientid=clients.id) as productscount FROM clients ORDER by (SELECT COALESCE(COUNT(products.id),0) FROM products WHERE products.clientid=clients.id) desc LIMIT 15";
$stmt = $db->query($query);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	if ($row['productscount']>0) {
		$colorid += 1;
		$procent = ($row['productscount'] * 100) / $allproducts;
		$procent = number_format($procent, 1, '.', ' ');
		$elements .= '<tr><td align="left">' .$row['email'] .'</td><td width="550"><div style="display:block;height:100%;background:' .$allcolors[$colorid] .';color:white;width:' .$procent .'%;text-align:right;padding:7px;padding-right:10px;">' .$row['productscount'] .'</div></td></tr>';
	}
}
?>
<div class="contoverall">
	<div class="contall">
        <div class="call centered paddingupdown centered">
			<h1 class="centered">БРОЙ КАЧЕНИ ПЕСНИ ПО ПОТРЕБИТЕЛ</h1>
			<table width="800" cellspacing="5">
				<?=$elements?>
			</table>
		</div>
	</div>
</div>
<?php
}
?>


<?php
require_once('down.php');
?>