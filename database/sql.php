<?php
function sqlConnection(){
    try{
        return new PDO("mysql:host=localhost;dbname=template_task","root","");
    }catch(Exception $send){
        exit("error ".$send->getMessage());
    }
}

?>