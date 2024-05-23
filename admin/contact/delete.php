<?php
include "../../database/sql.php";
$elaqe=sqlConnection();
if($_GET['id']){
    $userId=$_GET['id'];
    $query=$elaqe->prepare('DELETE from messages where id=?');
    $query->execute([
        $userId
    ]);
    header('location: index.php');
}
?>