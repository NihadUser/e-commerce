<?php
$firstCss="../userParts/style.css";
$cssUrl="../home/product.css";
include "../userParts/header.php";
include "../userParts/menu.php";
//  session_start();
 include "../../database/sql.php";
 $elaqe=sqlConnection();
    $query=$elaqe->prepare('SELECT basket.id,products.name as name,products.image,products.id as p_id,basket.quantity,products.price,products.discount_price from basket left join products on products.id=basket.product_id where basket.user_id=?');
    if(isset($_SESSION['user'])){
    $query->execute([
        $_SESSION['user']
    ]);
}
    $data=$query->fetchAll(PDO::FETCH_ASSOC);
 ?>
<?php
// echo $_POST['count[]'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    print_r($_POST['count[]']);
    print_r($_POST['aydi[]']);
	foreach ($_POST['aydi'] as $key => $item) {
		if (!empty($_POST['count'][$key])) {
			$query = $elaqe->prepare("UPDATE basket set quantity=? where user_id=? and product_id=?");
			$query->execute([
				$_POST['count'][$key],
				$_SESSION['user'],
				$_POST['aydi'][$key]
			]);
		}
	}
	 header('location: index.php');


}

?>

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
<div class="main">
    <div class="mainInner">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <table>
                <thead>
                    <tr>
                        <th class="x"></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                foreach($data as $datum){
                ?>
                    <tr>
                        <td class="x"><a href="delete.php?id=<?php echo $datum['id'] ?>">&times;</a></td>
                        <td>
                            <img src="../../uploads/<?php echo $datum['image'] ?>" alt="">
                        </td>
                        <td>
                            <?php echo $datum['name'] ?>
                        </td>
                        <td>
                            <?php
                            if($datum['price']==$datum['discount_price']){
                                echo "$".$datum['price'].".00";
                            }elseif ($datum['price']>$datum['discount_price']) {
                                echo "$".$datum['discount_price'].".00";
                            }
                            ?>
                        </td>
                        <td>
                            <input type="hidden" value="<?php echo $datum['p_id']?>" name="aydi[]">
                            <input class="input" type="number" name="count[]" min="0"
                                value="<?php echo $datum['quantity']?>">
                        </td>
                        <td>
                            <?php
                            if($datum['price']==$datum['discount_price']){
                                echo $total=$datum['quantity']*$datum['price']." $";
                            }elseif ($datum['price']>$datum['discount_price']) {
                                echo $total=$datum['quantity']*$datum['discount_price']." $";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>

                </tbody>
                <tfoot>

                    <tr>
                        <td colspan="6">
                            <button class="apply" type="submit">Apply</button>
                        </td>
                    </tr>
                </tfoot>
            </table>

        </form>
        <div class="total">

            <span class="amount">
                Total amount:
            </span>
            <span>
                <?php
                    echo "$".$cem.".00";
                    ?>
            </span>
        </div>
    </div>
</div>

<?php
include "../userParts/footer.php"
?>