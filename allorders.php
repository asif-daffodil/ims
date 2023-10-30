<?php
include_once("header.php");
?>
<div id="layoutSidenav">
    <?php
    include_once("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <div class="container-fluid px-4">
            <?php
            if (isset($_GET['cid'])) {
                $id = $_GET['cid'];
            ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, cancel it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Use AJAX to delete the record
                            $.ajax({
                                type: "POST", // You can use POST or GET
                                url: "ajax/order.php", // Create a PHP file to handle deletion
                                data: {
                                    cid: <?php echo $id; ?>
                                },
                                success: function(response) {
                                    if (response == 'success') {
                                        Swal.fire(
                                            'Canceled!',
                                            'Order has been canceled.',
                                            'success'
                                        );
                                        setTimeout(function() {
                                            window.location.href = "allorders.php";
                                        }, 2000);
                                    } else {
                                        Swal.fire(
                                            'Error!',
                                            'Something went wrong.',
                                            'error'
                                        );
                                    }
                                }
                            });
                        }
                    })
                </script>
            <?php
            }
            ?>

            <?php
            if (isset($_GET['eid'])) {
                $id = $_GET['eid'];
            ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to mark this order as completed!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Mark it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Use AJAX to delete the record
                            $.ajax({
                                type: "POST", // You can use POST or GET
                                url: "ajax/order.php", // Create a PHP file to handle deletion
                                data: {
                                    eid: <?php echo $id; ?>
                                },
                                success: function(response) {
                                    console.log(response);
                                    if (response == 'success') {
                                        Swal.fire(
                                            'Completed!',
                                            'Order has been completed.',
                                            'success'
                                        );
                                        setTimeout(function() {
                                            window.location.href = "allorders.php";
                                        }, 2000);
                                    } else {
                                        Swal.fire(
                                            'Error!',
                                            'Something went wrong.',
                                            'error'
                                        );
                                    }
                                }
                            });
                        }
                    })
                </script>
            <?php
            }
            ?>

            <?php
            if (isset($_GET['did'])) {
                $id = $_GET['did'];
                $sql = "SELECT * FROM `orders` WHERE `id` = '$id'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_object($result);
                $product_id = $row->product_id;
                $quantity = $row->quantity;
                $sql = "UPDATE `products` SET `stock` = `stock` + '$quantity' WHERE `id` = '$product_id'";
                $result2 = mysqli_query($conn, $sql);
                $sql = "DELETE FROM `orders` WHERE `id` = '$id'";
                $result = mysqli_query($conn, $sql);
                if ($result && $result2) {
                    # code...
                    echo "<script>toastr.success('Order Deleted Successfully')</script>";
                } else {
                    # code...
                    echo "<script>toastr.error('Order Not Deleted')</script>";
                }
            }
            ?>

            <h2>All Orders</h2>
            <div class="table-responsive">
                <!-- show all orders in datatable -->
                <table class="table table-striped table-sm" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Client Name</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // table name: orders; columns: `id`, `client_id`, `product_id`, `quantity`, `price`, `total`, `status`, `created_at`
                        // table name: clients; columns: `id`, `name`, `mobile`, `address`, `created_at` 
                        // table name: products; columns: `id`, `name`, `type_id`, `brand_id`, `description`, `price`, `stock`, `shelf_no`, `created_at`
                        $sql = "SELECT * FROM `orders` ORDER BY `id` DESC";
                        $result = mysqli_query($conn, $sql);
                        $i = 1;
                        while ($row = mysqli_fetch_object($result)) {
                            $client_id = $row->client_id;
                            $product_id = $row->product_id;
                            $client_sql = "SELECT * FROM `clients` WHERE `id` = '$client_id'";
                            $client_result = mysqli_query($conn, $client_sql);
                            $client_row = mysqli_fetch_object($client_result);
                            $product_sql = "SELECT * FROM `products` WHERE `id` = '$product_id'";
                            $product_result = mysqli_query($conn, $product_sql);
                            $product_row = mysqli_fetch_object($product_result);
                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $client_row->name ?></td>
                                <td><?= $client_row->mobile ?></td>
                                <td><?= $client_row->address ?></td>
                                <td><?= $product_row->name ?></td>
                                <td><?= $row->quantity ?></td>
                                <td><?= $row->price ?></td>
                                <td><?= $row->total ?></td>
                                <td><?= $row->status ?></td>
                                <td>
                                    <!-- if status is Pending -->
                                    <?php
                                    if ($row->status == 'Pending') {
                                    ?>
                                        <a href="./allorders.php?eid=<?= $row->id ?>" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                                        <a href="./allorders.php?cid=<?= $row->id ?>" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                    <?php
                                    }else{
                                        ?>
                                        <a href="./allorders.php?did=<?= $row->id ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    <?php   
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            include_once("footer.php");
            ?>
        </div>
    </div>
    </body>

    </html>