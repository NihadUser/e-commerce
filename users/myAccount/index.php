<?php
$firstCss="../userParts/style.css";
$cssUrl="style.css";
include "../userParts/header.php";
include "../userParts/menu.php";
?>
<div class="main">
    <div class="account">
        <h2 class="login">Account</h2>
        <?php
        include "../../database/sql.php";
        $elaqe=sqlConnection();
        $query=$elaqe->prepare("SELECT * from users where id=?");
        $query->execute([
            $_SESSION['user']
        ]);
        $data=$query->fetch(PDO::FETCH_ASSOC);
        ?>
        <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            session_start();
            session_destroy();
            header('location: ../home/index.php');
        }
?>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <input type="text" name="user" value="<?php echo $data['username'] ?>">
            <button type="submit">Log out</button>
            <a class="link1" href="change.php">Change name</a>
        </form>
    </div>
</div>
<?php
include "../userParts/footer.php";
?>