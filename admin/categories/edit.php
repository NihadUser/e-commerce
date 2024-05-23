<?php
include "../../database/sql.php";
$elaqe=sqlConnection();
if($_SERVER['REQUEST_METHOD']=='GET'){
    $query=$elaqe->prepare('SELECT * FROM categories where id=?');
    $query->execute([
        $_GET['id']
    ]);
    $data=$query->fetch(PDO::FETCH_ASSOC);
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(!empty($_POST['name']) ){
        $query=$elaqe->prepare('UPDATE categories set name=?,updated_at=now() where id=?');
        $query->execute([
            $_POST['name'],
            $_POST['id']
        ]);
        header('location:index.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <input type="text" name="id" value="<?php echo $data['id']?>" disabled>
        <input type="text" name="name" value="<?php echo $data['name'] ?>">
        <button type="submit">Edit</button>
    </form>
</body>

</html>