<?php
$cssUrl="../style.css";
include "../adminParts/header.php";
?>
<div class="container">
    <div class="main">
        <?php
        include "../adminParts/menu.php";
    ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category Id</th>
                    <th>Price</th>
                    <th>Discount Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
            // include "../../database/sql.php";
            // $elaqe=sqlConnection();
            $query=$elaqe->prepare("SELECT * from products");
            $query->execute();
            $data=$query->fetchAll(PDO::FETCH_ASSOC);
            ?>
                <?php
            foreach($data as $datum){
            ?>
                <tr>

                    <td>
                        <?php echo $datum['id'] ?>
                    </td>
                    <td>
                        <img src="../../uploads/<?php echo $datum['image'] ?>" alt="">
                        <?php echo $datum['name'] ?>
                    </td>
                    <td>
                        <?php echo $datum['description'] ?>
                    </td>
                    <td>
                        <?php echo $datum['category_id'] ?>
                    </td>
                    <td>
                        <?php echo $datum['price'] ?>
                    </td>
                    <td>
                        <?php echo $datum['discount_price'] ?>
                    </td>
                    <td>
                        <a class="delete" href="delete.php?id=<?php echo $datum['id']?>">Delete</a>
                        <a class="edit" href="edit.php?id=<?php echo $datum['id']?>">Edit</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <a class="add" href="add.php">Add product</a>
</div>