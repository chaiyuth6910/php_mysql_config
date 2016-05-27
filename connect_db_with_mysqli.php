<?php 
$connect = mysqli_connect($host, $username, $password, $dbname);
mysqli_set_charset($connect,"utf8");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>