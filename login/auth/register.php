<?php
$firstCss = "../../users/userParts/style.css";
$cssUrl = "style.css";
include "../../users/userParts/header.php";
include "../../users/userParts/menu.php";

$nameErr = $emailErr = $passErr = $userErr = "";
$n = $e = $p = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $userErr = "Name is required";
  } else {
    $n = test_input($_POST["name"]);
  }
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $n = test_input($_POST["name"]);
  }
  if (empty($_POST["password"])) {
    $passErr = "Name is required";
  } else {
    $n = test_input($_POST["password"]);
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $e = test_input($_POST["email"]);
  }

}


function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="main">
  <div class="account">

    <h2 class="login">Sign in</h2>

    <?php
    include "../../database/sql.php";
    $elaqe = sqlConnection();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (!empty($_POST['name']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $name = $_POST['name'];
        $userName = $_POST['username'];
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          $email = $_POST['email'];
          $psw = $_POST['password'];
          $hashPassword = password_hash($psw, PASSWORD_DEFAULT);
          $query = $elaqe->prepare("SELECT count(id) as count FROM users where email=? and username=?");
          $query->execute([$email, $userName]);
          $data = $query->fetch(PDO::FETCH_ASSOC);
          if ($data['count'] == 0) {
            $insert = $elaqe->prepare("INSERT INTO users(name,email,username,password,is_active,role) values(?,?,?,?,?,?)");
            $insert->execute([$name, $email, $userName, $hashPassword, 1, "user"]);
            header('location: login.php');
          } else {
            echo "<div class='alert'>This user has already exsist</div>";
            header('location: register.php');
          }
        } else {
          echo "<div class='alert'>Emaili duz girin</div>";
          // exit();
        }

      } else {
        echo "<div class='alert'>Fill all the fileds</div>";
      }
    }


    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <input type="text" name="name" placeholder="Enter name">
      <span class="error">* <?php echo $nameErr; ?></span>
      <input type="text" name="username" placeholder="Enter username">
      <span class="error">* <?php echo $userErr; ?></span>
      <input type="email" name="email" placeholder="Enter email adress">
      <span class="error">* <?php echo $emailErr; ?></span>
      <input type="password" name="password" placeholder="Enter password">
      <span class="error">* <?php echo $passErr; ?></span>
      <button type="submit">Register</button>
    </form>
  </div>
</div>

<?php
include "../../users/userParts/footer.php";
?>