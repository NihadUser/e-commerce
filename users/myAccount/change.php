<?php
$firstCss="../userParts/style.css";
$cssUrl="style.css";
include "../userParts/header.php";
include "../userParts/menu.php";
?>
<div class="main">
    <div class="account">
        <?php
        include "../../database/sql.php";
        $conn=sqlConnection();
       if($_SERVER['REQUEST_METHOD']=='POST'){
        $name=$_POST['name'];
        $query=$conn->prepare('SELECT count(id) as count from users where username=?');
        $query->execute([
            $name
        ]);
        $user=$query->fetch(PDO::FETCH_ASSOC);
        if($user['count']==0 && !empty($_POST['name'])){
            $query=$conn->prepare("UPDATE users set username=?,updated_at=now() where id=?");
            $query->execute([
                $_POST['name'],
                $_SESSION['user']
            ]);
            header('location: index.php');
        }else{
            echo "<div class='alert'>Fill the inpit</div>";
        }
       }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <input type="text" name="name" placeholder="Enter new username">
            <button type="submit">Change </button>
        </form>
    </div>
</div>
<?php
include "../userParts/footer.php";
?>