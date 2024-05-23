<?php
// session_start();
// if(isset($_SESSION['user'])){
//     include "../../database/sql.php";
//     $elaqe=sqlConnection();
//     $query=$elaqe->prepare("SELECT * from users where id=?");
//     $query->execute([
//         $_SESSION['user']
//     ]);
//     $user=$query->fetch();
//     if($user['role']=='admin'){
//         header('location: ../../admin/home/index.php');
//     }
//     if($user['role']=='user'){
//         header('location: ../../users/home/index.php');
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo $cssUrl?>">
    <link rel="stylesheet" href="<?php echo $firstCss ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>