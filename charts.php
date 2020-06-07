<?php



require_once('config.php');

require_once('template.php');



$tpl->get_tpl('up.htm');

$tpl->set_value('title','Контролен панел - ' .$t);

$tpl->set_value('description','Контролен панел. ' .$d);




$tpl->tpl_parse();

echo $tpl->html;



require_once('menu.php');





if ( $_GET['editid'] > 0) {

    try {

        $id = $_GET['editid'];

        $vis = $_GET['vis'];

        $newvis = 'Да';

        if ($vis=='Да') {

            $newvis = 'Не';

        }

        $sql = "UPDATE charts SET vis=:vis WHERE id=:id";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':vis', $newvis);

        $stmt->bindParam(':id', $id);

        $stmt->execute();



    }	catch (Exception $e) {

        die('<div class="col-md-8 mx-auto text-center alert alert-danger">' . $e->getMessage() .'</div>');

    }



}



?>

<div class="contoverall">

     <div class="slide">

		<img src="images/slider.jpg" class="objectfit" alt="WebMusic">

     </div>

</div>



<div class="contoverall">

	<div class="contall">

        <div class="call centered paddingupdown">

<?php

	$query = 'SELECT * FROM charts ORDER by id';

    $tablerows = '';

    $stmt = $db->query($query);

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

		$tablerows .= '<tr>';

        $tablerows .= '<td>' .$row['ime'] .'</td>';

		$tablerows .= '<td><a href="charts.php?editid=' .$row['id'] .'&vis=' .$row['vis'] .'">' .$row['vis'] .'</a></td>';

		$tablerows .= '</tr>';

	}

	echo '<table style="margin:auto" border="1">

		<thead class="thead-light">

		<tr>

            <th>Графика</th>

			<th>Да се вижда</th>

		</tr></thead>' .$tablerows .'</table></div></div>';

?>

        </div>

    </div>

</div>



<?php

require_once('down.php');

?>