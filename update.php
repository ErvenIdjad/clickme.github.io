<?php
if(!isset($_SESSION['username'])){
    header('location: login.php');
}

require_once 'dbconfig.php';

$username = $_SESSION['username'];
$clicks = $_POST['clicks'];

$query = "UPDATE users SET clicks = $clicks WHERE username = '$username'";
$result = mysqli_query($link, $query);

if($result) {
    echo 'success';
} else {
    echo 'error';
}
?>