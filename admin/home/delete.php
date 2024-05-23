<?php
include "../../database/sql.php";
$elaqe=sqlConnection();
if($_SERVER['REQUEST_METHOD']=="GET"){
        $userId=$_GET['id'];
        $query=$elaqe->prepare('DELETE FROM products WHERE id=?');
        $query->execute([
            $userId
        ]);
        header("location: index.php");
    }

?>