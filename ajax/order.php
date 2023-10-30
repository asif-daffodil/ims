<?php 
$conn = mysqli_connect("localhost","root","","ims");
if(isset($_POST['cid'])){
    $id = $_POST['id'];
    $sql = "UPDATE `orders` SET `status` = 'Canceled' WHERE `id` = '$id'";
    $result = mysqli_query($conn, $sql);
    // update stock in products table
    $sql = "SELECT * FROM `orders` WHERE `id` = '$id'";
    $result2 = mysqli_query($conn, $sql);
    $row = mysqli_fetch_object($result2);
    $product_id = $row->product_id;
    $quantity = $row->quantity;
    $sql = "UPDATE `products` SET `stock` = `stock` + '$quantity' WHERE `id` = '$product_id'";
    $result3 = mysqli_query($conn, $sql);
    if($result && $result2 && $result3){
        echo "success";
    }else{
        echo "fail";
    }
}
if(isset($_POST['eid'])){
    $id = $_POST['eid'];
    $sql = "UPDATE `orders` SET `status` = 'Delivered' WHERE `id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "success";
    }else{
        echo "fail";
    }
}
?>