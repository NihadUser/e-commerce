<?php
include "../../database/sql.php";
$elaqe=sqlConnection();
if($_SERVER["REQUEST_METHOD"]=="GET"){
    $query=$elaqe->prepare('SELECT * FROM users where id=?');
    $query->execute([
        $_GET['id']
    ]);
    $data=$query->fetch(PDO::FETCH_ASSOC);
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(!empty($_POST['role'])){
        $query=$elaqe->prepare('UPDATE users set role=?,is_active=?,updated_at=now() where id=?');
        $query->execute([
            $_POST['role'],
            $_POST['active'],
            $_POST['id']
        ]);
        header('location: index.php');
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
        <input type="text" name="id" value="<?php echo $data['id'] ?>">
        <input type="text" name="role" value="<?php echo $data['role']?>">
        <input type="text" name="active" value="<?php echo $data['is_active']?>">
        <button type="submit">Add</button>
    </form>
</body>

</html>