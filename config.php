<?php
$host="localhost";
$port=3306;
$user="variwear_20US";
$password="lora637845ST";
$dbname="variwear_21DB";

session_start(['cookie_httponly'=>true]);

try {
	$db = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8'));
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage() . "<br/>");
}

function CheckAvailability($db, $email, $id) {
	$fname = 0;
	try {
		$stmt = $db->query("SELECT count(*) FROM clients WHERE id<>" .$id ." AND email='" .$email ."'");
		$fname = $stmt->fetchColumn();
	} catch (Exception $e) {
	}
	return $fname;
}

function GetVid($db, $tableId) {
	$fname = '';
	try {
		$stmt = $db->query('SELECT ime FROM vidove WHERE id=' .$tableId);
		$fname = $stmt->fetchColumn();
	} catch (Exception $e) {
	}
	return $fname;
}

function GetVis($db, $tableId) {
	$fname = '';
	try {
		$stmt = $db->query('SELECT vis FROM charts WHERE id=' .$tableId);
		$fname = $stmt->fetchColumn();
	} catch (Exception $e) {
	}
	return $fname;
}

$clientid = 0;
if (isset($_COOKIE['sitecl'])) {
    $clientid = $_COOKIE['sitecl'];
}
else if (!isset($_SESSION['clientid'])) {
    $clientid = $_SESSION['clientid'];
} 
$stmt = $db->prepare("SELECT * FROM clients WHERE id=:id limit 1");
$stmt->execute(array(':id' => $clientid));
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $_SESSION['clientid'] = $row['id'];
    $_SESSION['client'] = $row['email'];  
    setcookie("sitecl", $row['id'], strtotime('+30 days'));
}

?>