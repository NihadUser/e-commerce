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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // include "../../database/sql.php";
                // $elaqe=sqlConnection();
                $query=$elaqe->prepare("SELECT * from categories");
                $query->execute();
                $data=$query->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php
                foreach($data as $single){
                ?>
                <tr>
                    <td><?php echo $single['id'] ?></td>
                    <td><?php echo $single['name'] ?></td>
                    <td>
                        <a class="delete" href="delete.php?id=<?php echo $single['id']?>">Delete</a>
                        <a class="edit" href="edit.php?id=<?php echo $single['id']?>">Edit</a>
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