<header>
    <div class="image">
        <img src="https://websitedemos.net/plant-store-02/wp-content/uploads/sites/410/2020/06/plants-store-logo-green.svg"
            alt="">
        <a href="">Simply Natural</a>
    </div>
    <ul>
        <li><a href="../home/index.php">Home</a></li>
        <li class="li">
            <a href="../store/index.php">Store</a>
            <ul class="ul">
                <li><a href="../plants/index.php">Plants</a></li>
                <li><a href="../plants/cactus.php">Cactus</a></li>
            </ul>
        </li>
        <li><a href="">About Us</a></li>
        <li><a href="../contact/index.php">Contact Us</a></li>
        <?php
        session_start();
        if(isset($_SESSION['user'])){
        ?>
        <li><a href="../card/index.php">Card</a></li>
        <?php
        }else{
            echo "";
        }
        ?>
        <li><a id="basket"><i class="fa-solid fa-basket-shopping"></i></a></li>
        <li>
            <?php
            if(isset($_SESSION['user'])){
                $link="../myAccount/index.php";
            }else{
                $link="../../login/auth/login.php";
            }
            ?>
            <a href="<?php echo $link ?>"><i class="fa-solid fa-user"></i></a>
        </li>
    </ul>

</header>