<?php

require_once('config.php');
require_once('template.php');

if (isset($_POST['email']) && isset($_POST['pass'])) {
    try {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_MAGIC_QUOTES);
        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_MAGIC_QUOTES);

        $passwd = '';
        $id = 0;
        $ime = '';
        $conf = 'No';

        $stmt = $db->prepare("SELECT * FROM clients WHERE email=:email limit 1");
        $stmt->execute(array(':email' => $email));
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $passwd = $row['pass'];
            $id = $row['id'];
        }
        $bool = password_verify($pass, $passwd);
        if ($bool == true) {
            $_SESSION['clientid'] = $id;
            $_SESSION['client'] = $email;
            setcookie("sitecl", $id, strtotime('+30 days'));
            echo "<script> location.href='login.php';</script>";
        }
        else {
        }
    } catch (Exception $e) {
    }
    die();
} elseif (isset($_POST['vid']) && isset($_POST['ime'])) {
    $vid= filter_input(INPUT_POST, 'vid', FILTER_VALIDATE_INT);
    $ime = filter_input(INPUT_POST, 'ime', FILTER_SANITIZE_MAGIC_QUOTES);
    $youtube = filter_input(INPUT_POST, 'youtube', FILTER_SANITIZE_MAGIC_QUOTES);

    $stmt = $db->prepare("insert into products (clientid, vid, ime, youtube) values (:clientid, :vid, :ime, :youtube)");
	$stmt->execute(array(':clientid' => $_SESSION['clientid'], ':vid' => $vid, ':ime' => $ime, ':youtube' => $youtube));

	echo "<script> location.href='login.php';</script>";

    die($result);
} elseif (isset($_GET['playid'])) {
    $id= filter_input(INPUT_GET, 'playid', FILTER_VALIDATE_INT);
    $sql = "UPDATE products SET played=played+1 WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
} elseif (isset($_GET['deleteid'])) {
    $id= filter_input(INPUT_GET, 'deleteid', FILTER_VALIDATE_INT);
    $sql = "DELETE FROM products WHERE clientid=" .$_SESSION['clientid'] ." AND id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

$clientid = 0;
$h1 = 'Вход | Профил';
if (isset($_COOKIE['sitecl'])) {
    $clientid = $_COOKIE['sitecl'];
}
else if (isset($_SESSION['clientid'])) {
    $clientid = $_SESSION['clientid'];
}
$stmt = $db->prepare("SELECT * FROM clients WHERE id=:id limit 1");
$stmt->execute(array(':id' => $clientid));
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $_SESSION['clientid'] = $row['id'];
    $_SESSION['client'] = $row['email'];
    $h1 = $_SESSION['client'];
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
$tpl->set_value('title','Вход | Профил - ' .$t);
$tpl->set_value('description','Вход | Профил. ' .$d);

$tpl->tpl_parse();
echo $tpl->html;

require_once('menu.php');

if ($clientid > 0) {
?>
<div class="contoverall">
	<div class="contall">
        <div class="call centered paddingupdown">
            <h1 class="centered">ДОБАВИ ПЕСЕН</h1>
            <form method="post" name="contactForm" action="login.php">
                <div class="mainscroll">
                    <div class="inputleft">Вид</div>
                    <div class="inputright"><select name="vid">
<?php
$stmtclients = $db->query("SELECT * FROM vidove ORDER by id");
$options = '';
while($row = $stmtclients->fetch(PDO::FETCH_ASSOC)) {
    $options .= '<option value="' .$row['id'] .'">' .$row['ime'] .'</option>';
}
echo($options);
?>
                </select></div>
                </div>
                <div class="mainscroll">
                    <div class="inputleft">Заглавие</div>
                    <div class="inputright"><input name="ime" type="ime"></div>
                </div>
                <div class="mainscroll">
                    <div class="inputleft">YouTube линк</div>
                    <div class="inputright"><input name="youtube" type="text" placeholder="https://www.youtube.com/watch?v=5t-wasokxRE"></div>
                </div>
                <div class="mainscroll">
                    <div class="inputleft">&nbsp;</div>
                    <div class="inputright"><a href="javascript:contactForm.submit();" class="buton">Добави</a></div>
                </div>
            </form>

        </div>
        <div class="call centered paddingupdown">
            <h1 class="centered">ВАШИТЕ ПЕСНИ</h1>
<?php
$songs = '';
$query = "SELECT * FROM products WHERE clientid=" .$clientid ." ORDER by id desc";
$records_per_page = 6;
$offset = 0;
if(isset($_GET["page"])) {
	$offset = ($_GET["page"]-1) * $records_per_page;
}
$query2 = $query. " limit " .$records_per_page ." OFFSET " .$offset;
$stmt = $db->query($query2);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $videoId = $row['youtube'];
    $videoId = str_replace('https://www.youtube.com/watch?v=','',$videoId);
    $iframe = '<div class="contproduct"><iframe id="' .$row['id'] .'" src="//www.youtube.com/embed/' .$videoId .'" frameborder="0" allowfullscreen allow="autoplay"></iframe><a href="javascript:getPlayed(' .$row['id'] .');" id="link' .$row['id'] .'" class="play">&nbsp;</a><a href="login.php?deleteid=' .$row['id'] .'" class="delete">X</a></div>';
    $songs .= $iframe;
}
echo($songs);

$sign = '?';
if (strpos($self, '?') > -1) {
    $sign = '&';
}
$row_count = $db->query($query)->rowCount();
$pagination = '';
if($row_count > 0) {
    $totalproducts = ceil($row_count/$records_per_page);
    $currentPage = 1;
    if(isset($_GET["page"])) {
        $currentPage = $_GET["page"];
    }
    if($currentPage != 1) {
        $previous = $currentPage-1;
        if($previous==1) {
            $pagination .= '<a class="page-link" href="' .$self .'">&laquo;</a>';
        }
        else {
            $pagination .= '<a class="page-link" href="' .$self .$sign .'page=' .$previous .'">&laquo;</a>';
        }
    }
    if($currentPage!=$totalproducts) {
        $next = $currentPage+1;
        $pagination .= '<a class="page-link" href="' .$self .$sign .'page=' .$next .'">&raquo;</a>';
    }
}
if ($row_count > $records_per_page) {
    $pagination = '<div class="text-center"><ul class="pagination justify-content-center">' .$pagination .'</ul></div>';
    echo $pagination;
}

?>
<script>
    function getPlayed(videoid) {
        fetch('login.php?playid=' + videoid, {method:'get'});
        var isAutoplay = false;
        if (document.getElementById(videoid).src.includes('?autoplay=1')) {
            document.getElementById(videoid).src = document.getElementById(videoid).src.replace('?autoplay=1','');
        } else {
            document.getElementById(videoid).src += "?autoplay=1";
            document.getElementById("link" + videoid).style.display="none";
        }
    }
</script>
        </div>


   </div>
</div>
<?php
} else {
?>

<div class="contoverall paddingupdown">
	<div class="contall">
        <div class="call centered">
            <h1 class="centered">ВАШИЯТ АКАУНТ</h1>
        </div>
        <div class="call centered">
            <form method="post" name="contactForm">
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
                    <div class="inputright"><a href="javascript:contactForm.submit();" class="buton">Вход</a><br>
                    <a href="register.php" class="buton">Регистрирайте се тук</a></div>
                </div>
            </form>

        </div>
   </div>
</div>
<?php
}
?>

<?php
require_once('down.php');
?>