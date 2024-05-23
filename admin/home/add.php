<?php
include "../../database/sql.php";
$elaqe = sqlConnection();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
        if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['d_price'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $dPrice = $_POST['d_price'];
            $category = $_POST['c_id'];
            
            if ($_FILES['file']) {
                $file = $_FILES['file'];
                $fileName = $file['name'];
                $fileType = $file['type'];
                $fileTemp = $file['tmp_name'];
                $fileSize = $file['size'];
                $error = $file['error'];
                $fileExtension = explode(".", $fileName);
                $realFileExtensions = end($fileExtension);
                $allowedExtensions = ["png", "jpeg", "jpg"];
                if ($error == 0 && in_array($realFileExtensions, $allowedExtensions)) {
                    $newFileName = uniqid("", true);
                    $filePath = "../../uploads/" . $newFileName . "." . $realFileExtensions;
                    move_uploaded_file($fileTemp, $filePath);
                    $query = $elaqe->prepare('INSERT INTO products(name, description, image, price, discount_price, category_id) VALUES (?, ?, ?, ?, ?, ?)');
                    $query->execute([
                        $name,
                        $description,
                        $newFileName . "." . $realFileExtensions,
                        $price,
                        $dPrice,
                        $category
                    ]);

                    header("location: index.php");
                    
                }
            }
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
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Enter name">
        <input type="text" name="description" placeholder="Enter description">
        <input type="file" name="file">
        <input type="text" name="price">
        <input type="text" name="d_price">

        <?php
        $select = $elaqe->prepare('SELECT * from categories');
        $select->execute();
        $data = $select->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <select name="c_id">
            <?php
            foreach ($data as $cat) {
            ?>
            <option value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></option>
            <?php
            }
            ?>
        </select>
        <button type="submit">Add</button>
    </form>
</body>

</html>