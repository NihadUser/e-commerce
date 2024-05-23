<?php
$cssUrl="../style.css";
include "../adminParts/header.php";
?>
<div class="container">
    <div class="main">
        <?php
        include "../adminParts/menu.php";
        $elaqe=sqlConnection();
        $query=$elaqe->prepare('SELECT * FROM messages');
        $query->execute();
        $data=$query->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Message</th>
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
                    <td><?php echo $datum['subject'] ?></td>
                    <td><?php echo $datum['message'] ?></td>
                    <td>
                        <a class="delete" href="delete.php?id=<?php echo $datum['id']?>">Delete</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>