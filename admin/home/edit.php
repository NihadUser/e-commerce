<?php
include "../../database/sql.php";
$elaqe=sqlConnection();
if($_SERVER["REQUEST_METHOD"]==="GET"){
    $query=$elaqe->prepare('SELECT * FROM products where id=?');
    $query->execute([
        $_GET['id']
    ]);
    $data=$query->fetch(PDO::FETCH_ASSOC);
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['d_price'])){
        $query=$elaqe->prepare('UPDATE products set name=?,description=?,price=?,discount_price=?,updated_at=now() where id=?');
        $query->execute([
            $_POST['name'],
            $_POST['description'],
            $_POST['price'],
            $_POST['d_price'],
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
        <input type="text" name="id" value="<?php echo $data['id'] ?>">
        <input type="text" name="name" value="<?php echo $data['name']?>">
        <input type="text" name="description" value="<?php echo $data['description']?>">
        <input type="text" name="price" value="<?php echo $data['price']?>">
        <input type="text" name="d_price" value="<?php echo $data['discount_price']?>">
        <button type="submit">Add</button>
    </form>
</body>

</html>