<?php
include_once("header.php");
?>
<div id="layoutSidenav">
    <?php
    include_once("sidebar.php");
    // tabel name orders
    // columns: `id`, `client_id`, `product_id`, `quantity`, `price`, `total`, status, `created_at`
    if (isset($_POST['addorders'])) {
        # code...
        $client_id = safuda($_POST['client_id']);
        $product_id = safuda($_POST['product_id']);
        $quantity = safuda($_POST['quantity']);
        // select price from products table
        $sql = "SELECT * FROM `products` WHERE `id` = '$product_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_object($result);
        $price = $row->price;
        $total = $price * $quantity;
        // validate client_id | product_id | quantity
        if (empty($client_id)) {
            # code...
            echo "<script>toastr.error('Client is Required')</script>";
        } else {
            # code...
            if (empty($product_id)) {
                # code...
                echo "<script>toastr.error('Product is Required')</script>";
            } else {
                # code...
                if (empty($quantity)) {
                    # code...
                    echo "<script>toastr.error('Quantity is Required')</script>";
                } else {
                    # code...
                    if ($quantity > $row->stock) {
                        # code...
                        echo "<script>toastr.error('Quantity is Greater than Stock')</script>";
                    } else {
                        # code...
                        // insert into orders table
                        $sql = "INSERT INTO `orders` (`client_id`, `product_id`, `quantity`, `price`, `total`) VALUES ('$client_id', '$product_id', '$quantity', '$price', '$total')";
                        $result = mysqli_query($conn, $sql);
                        // update stock in products table
                        $sql = "UPDATE `products` SET `stock` = `stock` - '$quantity' WHERE `id` = '$product_id'";
                        $result2 = mysqli_query($conn, $sql);
                        if ($result && $result2) {
                            # code...
                            echo "<script>toastr.success('New Order Added Successfully')</script>";
                        } else {
                            # code...
                            echo "<script>toastr.error('New Order Not Added')</script>";
                        }
                    }
                }
            }
        }
    }
    ?>
    <div id="layoutSidenav_content">
        <div class="container-fluid px-4">
            <h2>Add New Orders</h2>
            <div class="row">
                <div class="col-md-6">
                    <!-- Form to add new orders -->
                    <form action="" method="post">
                        <div class="mb-3 form-floating ">
                            <select name="client_id" class="form-control" id="selectClient">
                                <option value="">Select Client</option>
                                <option value="addnew">Add New Client</option>
                                <?php
                                $sql = "SELECT * FROM `clients`";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_object($result)) {
                                ?>
                                    <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <label for="">Client</label>
                        </div>
                        <div class="mb-3 form-floating ">
                            <select name="product_id" id="" class="form-control">
                                <option value="">Select Product</option>
                                <?php
                                $sql = "SELECT * FROM `products`";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_object($result)) {
                                ?>
                                    <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <label for="">Product</label>
                        </div>
                        <div class="mb-3 form-floating ">
                            <input type="number" placeholder="Quantity" name="quantity" class="form-control">
                            <label for="">Quantity</label>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Add Orders" name="addorders" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
            <?php
            include_once("footer.php");
            ?>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#selectClient").change(function() {
                var client_id = $(this).val();
                if (client_id == "addnew") {
                    window.location.href = "addnewclient.php";
                }
            });
        });
    </script>
    </body>

    </html>