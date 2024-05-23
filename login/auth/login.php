<?php
$firstCss = "../../users/userParts/style.css";
$cssUrl = "style.css";
include "../../users/userParts/header.php";
include "../../users/userParts/menu.php";
?>
<div class="main">
    <div class="account">
        <h2 class="login">Log in</h2>
        <?php
        include "../../database/sql.php";
        $elaqe = sqlConnection();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty ($_POST['username']) && !empty ($_POST['password'])) {
                $query = $elaqe->prepare("SELECT * from users where username=?");
                $query->execute([$_POST['username']]);
                $user = $query->fetch(PDO::FETCH_ASSOC);
                if ($user != false) {
                    if ($user['username'] == $_POST['username'] && password_verify($_POST['password'], $user['password'])) {
                        $_SESSION['user'] = $user['id'];
                        if ($user['role'] == "admin") {
                            header('location: ../../admin/home/index.php');
                        }
                        if ($user['role'] == 'user') {
                            header('location: ../../users/home/index.php');
                        }
                    }
                } else {
                    echo "<div class='alert'>Isdifadeci adi ve ya sifre yanlisdir</div>";
                }
            } else {
                echo "<div class='alert'>Hamsini doldur</div>";
            }
        }

        ?>


        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <input type="text" name="username" placeholder="Enter username">
            <input type="password" name="password" placeholder="Enter password">
            <p class="content">If you dont have account? <a href="register.php">Sign in</a></p>
            <button type="submit">Enter</button>
        </form>
    </div>
</div>
<?php
include "../../users/userParts/footer.php";
?>