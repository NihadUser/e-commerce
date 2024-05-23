<?php
$firstCss="../userParts/style.css";
$cssUrl="style.css";
include "../userParts/header.php";
?>
<div class="main">
    <div class="main1">
        <div class="main1Inner">
            <h1>Store</h1>
        </div>
        <?php
        include "../userParts/menu.php";
        ?>
    </div>
    <div class="main2">
        <h1>Our Plants Collection</h1>
        <div class="products">
            <?php
            include "../../database/sql.php";
            $elaqe=sqlConnection();
            $query=$elaqe->prepare("SELECT products.id,products.discount_price,products.name,products.price,products.image,categories.name as c_name from products left join categories on categories.id=products.category_id");
            $query->execute();
            $data=$query->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php
            foreach($data as $datum){
            ?>
            <div class="product">
                <img src="../../uploads/<?php echo $datum['image']?>" alt="">
                <span class="category"><?php echo $datum['c_name'] ?></span>
                <a class="link"
                    href="../home/products.php?id=<?php echo $datum['id']?>"><?php echo $datum['name'] ?></a>
                <?php 
                if($datum['price']==$datum['discount_price']){
                ?>
                <span class="price">$<?php echo $datum['price'] ?>.00</span>
                <?php
                }elseif($datum['price']>$datum['discount_price']){
                ?>
                <span class="delPrice">$<?php echo $datum['price'] ?>.00</span>
                <span class="disPrice">$<?php echo $datum['discount_price'] ?>.00</span>
                <?php
                }
                ?>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<script src="../home/app.js"></script>
<?php
include "../userParts/footer.php";
?>