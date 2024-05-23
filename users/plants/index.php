<?php
$firstCss="../userParts/style.css";
$cssUrl="style.css";
include "../userParts/header.php";
?>
<div class="main">
    <?php
        include "../userParts/menu.php";
    ?>
    <?php 
        include "../../database/sql.php";
        $elaqe=sqlConnection();
        $a=1;
        $query=$elaqe->prepare("SELECT products.id,products.discount_price,products.name,products.price,products.image,categories.name as c_name from products left join categories on products.category_id=categories.id where products.category_id=?");
        $query->execute([
            $a
        ]);
        $data=$query->fetchAll(PDO::FETCH_ASSOC);
        ?>
    <div class="container">
        <div class="content">
            <div class="main1">
                <!-- <div class="price-range">
                    <input type="range" id="priceRange" min="25" max="80" value="25" step="1">
                    <div class="slider">
                        <div class="slider-thumb"></div>
                    </div>
                    <div class="price-values">
                        <span id="minPrice">$25</span>
                        <span id="maxPrice">$80</span>
                    </div>
                </div> -->
                <div class="categories">
                    <p>Categories</p>
                    <div class="line">
                        <a href="index.php">Plants</a>
                        <span>(6)</span>
                    </div>
                    <div class="line">
                        <a href="cactus.php">Cactus</a>
                        <span>(6)</span>
                    </div>
                </div>
                <div class="relatedProducts">
                    <?php
                    for($i=0;$i<3;$i++){
                    ?>
                    <div class="relatedProduct">
                        <img src="../../uploads/<?php echo $data[$i]["image"] ?>" alt="">
                        <a class="link"
                            href="../home/products.php?id=<?php echo $data[$i]['id'] ?>"><?php echo $data[$i]['name'] ?></a>
                        <span><?php echo "$".$data[$i]['discount_price'].".00" ?></span>
                    </div>

                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="main2">
                <span>Home/Plants</span>
                <h1>Plants</h1>
                <span class="results">Showing all <?php echo count($data)?> results</span>
                <div class="products">
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
    </div>
</div>
<!-- <script src="script.js"></script> -->
</div>
<?php
include "../userParts/footer.php";
?>