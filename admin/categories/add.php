<?php
$cssUrl="../style.css";
include "../adminParts/header.php";
?>
<?php
include "../../database/sql.php";
$elaqe=sqlConnection();
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(!empty($_POST['name'])){
        $query=$elaqe->prepare("INSERT INTO categories(name) values (?)");
        $query->execute([
            $_POST['name']
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
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <input type="text" name="name" placeholder="Enter category">
        <button>Add</button>
    </form>
</body>

</html>