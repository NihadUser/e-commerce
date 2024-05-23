<?php
$firstCss="../userParts/style.css";
$cssUrl="style.css";
include "../userParts/header.php";
?>
<div class="main">
    <div class="main1">
        <div class="main1Inner">
            <h1>Contact</h1>
        </div>
        <?php
        include "../userParts/menu.php";
        include "../../database/sql.php";
        $conn=sqlConnection();
           if($_SERVER['REQUEST_METHOD']=='POST'){
            if(isset($_SESSION['user'])){
                if(!empty($_POST['name']) && !empty($_POST['subject']) && !empty($_POST['email']) && !empty($_POST['message'])){
                    $query=$conn->prepare('INSERT into messages(name,subject,message,user_id) values (?,?,?,?)');
                    $query->execute([
                        $_POST['name'],
                        $_POST['subject'],
                        $_POST['message'],
                        $_SESSION['user']
                    ]);
                    header('location: index.php');
                }
            }else{
                header('location: ../../errorPages/index.php');
            }
           }
        ?>
        <div class="main2">
            <div class="container">
                <div class="contact">
                    <h3 class="send">
                        Send Us a Message
                    </h3>
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                        <?php
                    if(isset($_SESSION['user'])){
                    ?>
                        <input type="text" name="name" placeholder="Name">
                        <input type="email" name="email" placeholder="Email">
                        <input type="text" name="subject" placeholder="Subject">
                        <textarea name="message" name="message" placeholder="Message" cols="30" rows="10"></textarea>
                        <button type="submit">Send</button>
                    </form>
                    <?php
                    }else{
                    ?>
                    <input type="text" name="name" placeholder="Name">
                    <input type="email" name="email" placeholder="Email">
                    <input type="text" name="subject" placeholder="Subject">
                    <textarea name="message" name="message" placeholder="Message" cols="30" rows="10"></textarea>
                    <button type="submit" disabled>Send</button>
                    <?php
                    }
                    ?>
                </div>
                <div class="map">
                    <div class="mapContainer">
                        <h3 class="send">
                            Find Us
                        </h3>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m21!1m12!1m3!1d45361.89476853492!2d48.8103526670641!3d41.15083076917607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m6!3e6!4m3!3m2!1d41.1562304!2d48.761487699999996!4m0!5e1!3m2!1sen!2saz!4v1689343413579!5m2!1sen!2saz"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "../userParts/footer.php";
?>