<?php

$self = $_SERVER['PHP_SELF'];

$menu = '<div class="contoverallup">    
<div class="contall">
	<div class="call centered">
		<div class="clogo">
			<a href="/"><img src="images/logo.png" alt="WebMusic" title="WebMusic"></a>
		</div>
	</div>
</div>
</div>

<div class="contoverallmenu">
<div class="contall">
	<div class="callmenu">
			<nav id="menu">
				<ul id="nav">
					<li><a href="/" class="first">СТАТИСТИКА</a></li>';
$query = "SELECT * FROM vidove ORDER by id";
$stmt = $db->query($query);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$menu .= '<li><a href="songs.php?v=' .$row['id'] .'">' .$row['ime'] .'</a></li>';
}
$menu .= '<li><a href="search.php">Търсене</a></li><li><a href="login.php">Вашият акаунт</a><ul>';
if ($clientid > 0) {
	if ($_SESSION['client']=='admin@admin.com') {
		$menu .= '<li><a href="charts.php">Контролен панел</a></li>';
	}
	$menu .= '<li><a href="logout.php">Изход</a></li>';
}
$menu .= '</ul></li>
			   </ul>
			</nav>             
	</div>
</div>
</div>';

echo $menu;

?>