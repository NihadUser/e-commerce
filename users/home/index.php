<?php
$firstCss="../userParts/style.css";
$cssUrl="style.css";
include "../userParts/header.php";
?>
<div class="main">
    <div class="main1">
        <?php
        include "../userParts/menu.php";
        ?>
        <div class="main1Content">
            <div class="main1Text">
                <p>Best Quality Plants</p>
                <h1>
                    Amazing Variety Of Plants Starting Just $6
                </h1>
                <a href="#">Shop Now</a>
            </div>
        </div>
        <div class="basketContainer" id="basket1">
            <div class="mainBasket" id="basket2">
                <div class="colser">
                    <span id="close">
                        &times;
                    </span>
                </div>

                <?php
                include "../../database/sql.php";
                $elaqe=sqlConnection();
                $query=$elaqe->prepare("SELECT basket.quantity,products.name,products.price,products.discount_price,products.image from basket left join products on products.id=basket.product_id where basket.user_id=?");
                $query->execute([
                    $_SESSION['user']
                ]);
                $data=$query->fetchAll(PDO::FETCH_ASSOC);
               
                ?>
                <ul>
                    <?php
                foreach($data as $datum){
                ?>
                    <li>
                        <div class="basketInner">
                            <div class="img">
                                <img src="../../uploads/<?php echo $datum['image'] ?>" alt="">
                            </div>
                            <div class="basketContent">
                                <p><?php echo $datum['name'] ?></p>
                                <?php echo $datum['quantity']?> &times; $<?php
                                if($datum['price']==$datum['discount_price']){
                                ?>
                                <span><?php echo $datum['price']?></span>
                                <?php
                                }elseif($datum['price']>$datum['discount_price']){
                                ?>
                                <span><?php echo $datum['discount_price'] ?></span>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
                </ul>
                <div class="info">
                    <span>Subtotal :</span>
                    <span>
                        <?php
                        $cem=0;
                        $arr=[];
                        foreach($data as $datum){
                            if($datum['price']==$datum['discount_price']){
                                $price=$datum['price']*$datum['quantity'];
                            }elseif($datum['price']>$datum['discount_price']){
                                $price=$datum['discount_price']*$datum['quantity'];
                            }
                            array_push($arr,$price);
                        }
                        for($i=0;$i<count($arr);$i++){
                            $cem+=$arr[$i];
                        }
                        ?>
                        <span><?php echo $cem." $"?></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="main3">
        <div class="main3Inner">
            <div class="items">
                <p class="item1">Beautiful Plant Varieties</p>
                <p class="item2">Luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                <a href="" class="item3">SEE COLLECTION</a>
            </div>
            <div class="items items2">
                <p class="item1">Beautiful Plant Varieties</p>
                <p class="item2">Luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                <a href="" class="item3">SEE COLLECTION</a>
            </div>
            <div class="items items3">
                <p class="item1">Beautiful Plant Varieties</p>
                <p class="item2">Luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
                <a href="" class="item3">SEE COLLECTION</a>
            </div>
        </div>
    </div>
    <div class="main2">
        <p class="main2Title">Featured Plants</p>
        <p class="main2Content">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <div class="products">
            <?php
            
            $query=$elaqe->prepare('SELECT products.id,products.name,products.image,products.price,products.discount_price,categories.name as category_name FROM products left join categories on products.category_id=categories.id');
            $query->execute();
            $data=$query->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php
            foreach($data as $datum){
            ?>
            <div class="product">
                <img src="../../uploads/<?php echo $datum['image'] ?>" alt="">
                <span class="category"><?php echo isset($datum['category_name'])?$datum['category_name'] : " " ?></span>
                <a class="link"
                    href="products.php?id=<?php echo $datum['id']?>"><?php echo isset($datum['name'])?$datum['name']:"" ?>
                </a>
                <div class="stars">
                    <?php
                    for($i=0;$i<4;$i++){
                    ?>
                    <i class="fa-regular fa-star"></i>
                    <?php
                    }
                    ?>
                </div>
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
    <?php
        include "../userParts/part.php";
        ?>
    <?php
    include "../userParts/footer.php";
    ?>
    <script src="app.js">

    </script>
</div>