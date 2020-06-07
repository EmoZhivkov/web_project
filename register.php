<?php

require_once('config.php');
require_once('template.php');

if (isset($_POST['email']) && isset($_POST['pass'])) {
    try {

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_MAGIC_QUOTES);
        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_MAGIC_QUOTES);

        //check if available email
        $checkemail = CheckAvailability($db, $email, 0);
		if ($checkemail > 0) {
			die('Мейлът се ползва от друг потребител');
        }
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $stmt = $db->prepare("insert into clients (email, pass) values (:email, :pass)");
        $stmt->execute(array(':email' => $email, ':pass' => $pass));
        $last_id = $db->lastInsertId();

        $_SESSION['clientid'] = $last_id;
        $_SESSION['client'] = $email;
        setcookie("sitecl", $last_id, strtotime('+30 days'));

        echo "<script> location.href='login.php';</script>";

    } catch (Exception $e) {
        echo'Възникна грешка: ' ,$e->getMessage();
    }
    die();
}

$t = '';
$d = '';
$query = 'SELECT * FROM dumi WHERE id=1';
$stmt = $db->query($query);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $t = $row['t'];
    $d = $row['d'];
}

$tpl->get_tpl('up.htm');
$tpl->set_value('title',$ime .' - ' .$t);
$tpl->set_value('description','Регистрация. ' .$d);

$tpl->tpl_parse();
echo $tpl->html;

require_once('menu.php');

?>

<div class="contoverall paddingupdown">
	<div class="contall">
        <div class="call centered">
            <h1 class="centered">РЕГИСТРАЦИЯ</h1>
        </div>
       <div class="call centered">
            <form method="post" name="contactForm" action="register.php">
                <div class="mainscroll">
                    <div class="inputleft">Email</div>
                    <div class="inputright"><input name="email" type="email"></div>
                </div>
                <div class="mainscroll">
                    <div class="inputleft">Парола</div>
                    <div class="inputright"><input name="pass" type="password"></div>
                </div>
                <div class="mainscroll">
                    <div class="inputleft">&nbsp;</div>
                    <div class="inputright"><a href="javascript:contactForm.submit();" class="buton">Регистрация</a></div>
                </div>
            </form>
        </div>
   </div>
</div>

<?php
require_once('down.php');
?>