<?php
include "../../database/sql.php";
$elaqe=sqlConnection();
if($_SERVER['REQUEST_METHOD']=='GET'){
    $query=$elaqe->prepare("DELETE from basket where id=?");
    $query->execute([$_GET['id']]);
    header('location: index.php');
}
?>