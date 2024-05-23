<?php
$firstCss="../userParts/style.css";
$cssUrl="product.css";
include "../userParts/header.php";
include "../userParts/menu.php";
?>
<div class="main">
    <div class="mainInner">
        <?php
        include "../../database/sql.php";
        $elaqe=sqlConnection();
        // if($_GET['id']){
            $query=$elaqe->prepare("SELECT products.id,products.name,products.image,products.price,products.discount_price,products.description,categories.name as category_name FROM products left join categories on products.category_id=categories.id where products.id=?");
        $query->execute([
            $_GET['id']
        ]);
        $data=$query->fetch((PDO::FETCH_ASSOC));
    // }
    // else{
    //     // header('location: ../../errorPages/404.php');
    // }
        ?>
        <div class="mainContent">
            <div class="image">
                <img src="../../uploads/<?php echo $data['image'] ?>" alt="">
            </div>
            <div class="content">
                <span class="category"><?php echo $data['category_name'] ?></span>
                <p class="name"><?php echo $data['name'] ?></p>
                <?php
                if($data['price']==$data['discount_price']){
                ?>
                <span class="price">$<?php echo $data['price'] ?>.00 <span class="free">+ Free shipping</span> </span>
                <?php
                }elseif($data['price']>$data['discount_price']){
                ?>
                <span class="delPrice">$<?php echo $data['price'] ?>.00</span>
                <span class="disPrice">$<?php echo $data['discount_price']?>.00 <span class="free">+ Free
                        shipping</span></span>
                <?php
                }
                ?>
                <p class="description">
                    <?php echo $data['description']?>
                </p>
                <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    if(isset($_SESSION['user'])){
                    $userId=$_POST['id'];
                    $query=$elaqe->prepare("SELECT * from basket where user_id=? and product_id=?");
                    $query->execute([
                        $_SESSION['user'],
                        $userId
                    ]);
                    $data=$query->fetch(PDO::FETCH_ASSOC);
                    if($data['quantity']>=1){
                        $query=$elaqe->prepare("UPDATE basket set quantity=?+?,updated_at=now() where user_id=? and product_id=?");
                        $query->execute([
                            $data['quantity'],
                            $_POST['count'],
                            $_SESSION['user'],
                            $userId
                        ]);
                        header("location: products.php?id=$userId");
                    }else{
                        $query=$elaqe->prepare('INSERT INTO basket(user_id,product_id,quantity) values (?,?,?)');
                        $query->execute([
                            $_SESSION['user'],
                            $userId,
                            $_POST['count']
                    ]);
                    header("location: products.php?id=$userId");
                }
                }else{
                    header('location: ../../errorPages/index.php');
                    exit();
                    // echo "<div>You should register hacker bey</div>";
                }
            }
                
                ?>
                <?php
                if(isset($_SESSION['user'])){
                    $query=$elaqe->prepare("SELECT basket.quantity,basket.product_id FROM basket where user_id=?");
                    $query->execute([
                        $_SESSION['user']
                    ]);
                    $basket=$query->fetch(PDO::FETCH_ASSOC);
                }else{
                    echo "";
                }
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <?php
                    if(isset($_SESSION['user'])){
                    ?>
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                    <input type="number" name="count" class="number" value="1">
                    <button type="submit">Add to Card</button>
                    <?php
                    }elseif(!isset($_SESSION['user'])){
                    ?>
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                    <input type="number" disabled name="count" class="number" value="1">
                    <button disabled>Add to Card</button>
                    <?php
                    }
                    ?>
                </form>
                <hr>
                <span class="cName">Category :<?php echo $data['category_name'] ?></span>
            </div>
        </div>
        <p class="products">Related Products</p>
        <div class="relatedProducts">

        </div>
    </div>
</div>
<?php
    include "../userParts/footer.php";
?>
<script>
function submitForm(event) {
    event.preventDefault(); // Prevent the default form submission behavior
    // Handle form submission logic here
    // You can use AJAX to submit the form data asynchronously if needed

    // For synchronous form submission using PHP, you can use the following code:
    // Assuming you have jQuery library included in your project
    /*$.ajax({
      type: "POST",
      url: "process_form.php",
      data: $(event.target).serialize(),
      success: function(response) {
        // Handle the response from the server
      }
    });*/

    return false; // Return false to prevent the form from submitting
}
</script>