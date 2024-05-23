<?php
session_start();
if(isset($_SESSION['user'])){
    include "../../database/sql.php";
    $elaqe=sqlConnection();
    $query=$elaqe->prepare("SELECT * from users where id=?");
    $query->execute([
        $_SESSION['user']
    ]);
    $user=$query->fetch();
    if($user['role']=='user'){
        header('location: ../../users/home/index.php');
    }
}
else{
    header('location:../users/index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo $cssUrl?>">
</head>

<body>