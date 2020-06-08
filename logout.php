<?php

session_start();

unset($_SESSION['clientid']);
unset($_SESSION['client']);

setcookie("sitecl", 'content', 1);

session_destroy();

Header('Location: index.php');

?>