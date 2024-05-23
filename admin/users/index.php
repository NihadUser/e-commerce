<?php
$cssUrl="../style.css";
include "../adminParts/header.php";
?>
<div class="container">
    <div class="main">
        <?php
        include "../adminParts/menu.php";
        // include "../../database/sql.php";
        $elaqe=sqlConnection();
        $query=$elaqe->prepare('SELECT * from users');
        $query->execute();
        $data=$query->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($data as $datum){
                ?>
                <tr>
                    <td><?php echo $datum['id'] ?></td>
                    <td><?php echo $datum['name'] ?></td>
                    <td><?php echo $datum['email'] ?></td>
                    <td><?php echo $datum['username'] ?></td>
                    <td><?php echo $datum['role'] ?></td>
                    <td><?php echo $datum['is_active'] ?></td>
                    <td>
                        <a class="edit" href="edit.php?id=<?php echo $datum['id']?>">Edit</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>